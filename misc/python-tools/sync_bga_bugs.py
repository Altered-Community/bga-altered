#!/usr/bin/env python3
"""
Sync Board Game Arena bug reports to GitHub Issues.

Uses Playwright (headless Chromium) to render the BGA bugs page.
No authentication required.

Required GitHub Variables (optional, has defaults):
  - BGA_GAME_ID  : BGA game ID (default: 1909)

Required:
  - GITHUB_TOKEN : Automatically provided by GitHub Actions
  - GITHUB_REPO  : Automatically provided by GitHub Actions
"""

import os
import re
import sys
import time
import logging
from pathlib import Path

from playwright.sync_api import sync_playwright, TimeoutError as PlaywrightTimeout
from github import Github, GithubException

logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s [%(levelname)s] %(message)s",
    datefmt="%Y-%m-%d %H:%M:%S",
)
log = logging.getLogger(__name__)

BGA_BUGS_URL = (
    "https://boardgamearena.com/bugs?game={game_id}"
    "&statuses=confirmed"
)
BGA_BUG_URL = "https://boardgamearena.com/bug?id={bug_id}"

LABEL_BGA = "bga-bug"

EXTRACT_JS_PATH = Path(__file__).parent / "extract_bugs.js"

BGA_STATUS_LABELS = {
    "open": ("bga-open", "e4e669", "BGA status: Open"),
    "infoneeded": ("bga-info-needed", "FCC94F", "BGA status: Info Needed"),
    "infos requises": ("bga-info-needed", "FCC94F", "BGA status: Info Needed"),
    "confirmed": ("bga-confirmed", "0075ca", "BGA status: Confirmed"),
    "confirme": ("bga-confirmed", "0075ca", "BGA status: Confirmed"),
    "awaiting": ("bga-awaiting", "cfd3d7", "BGA status: Awaiting"),
    "en attente": ("bga-awaiting", "cfd3d7", "BGA status: Awaiting"),
    "inforequest": ("bga-info-request", "d93f0b", "BGA status: Info Request"),
    "acknowledged": ("bga-acknowledged", "1d76db", "BGA status: Acknowledged"),
    "implemented": ("bga-implemented", "0e8a16", "BGA status: Implemented"),
    "implemente": ("bga-implemented", "0e8a16", "BGA status: Implemented"),
    "rejected": ("bga-rejected", "b60205", "BGA status: Rejected"),
    "rejete": ("bga-rejected", "b60205", "BGA status: Rejected"),
}

ALL_STATUS_LABEL_NAMES = {v[0] for v in BGA_STATUS_LABELS.values()}

def normalise_str(s):
    replacements = {"é": "e", "è": "e", "ê": "e", "à": "a", "î": "i", "ô": "o", "û": "u"}
    s = s.lower()
    for src, dst in replacements.items():
        s = s.replace(src, dst)
    return s

def resolve_status_label(status_text: str) -> tuple:
    normalised = normalise_str(status_text)
    for key, value in BGA_STATUS_LABELS.items():
        if key in normalised:
            return value
    slug = normalised.replace(" ", "-")
    return (f"bga-{slug}", "ededed", f"BGA status: {status_text}")

def fetch_bugs(game_id: str) -> list:
    url = BGA_BUGS_URL.format(game_id=game_id)
    log.info("Opening %s with headless Chromium...", url)

    extract_js = EXTRACT_JS_PATH.read_text(encoding="utf-8")
    bugs = []

    with sync_playwright() as p:
        browser = p.chromium.launch(headless=True)
        context = browser.new_context(locale="en-US")
        page = context.new_page()

        page.goto(url, wait_until="networkidle", timeout=60000)

        try:
            page.wait_for_selector("tr.cursor-pointer", timeout=30000)
        except PlaywrightTimeout:
            browser.close()
            return bugs

        seen_ids = set()

        def normalise_rows(items):
            result = []
            for item in items:
                bid = item.get("bugId") or f"hash_{abs(hash(item.get('title', '')))}"
                if not item.get("title") or bid in seen_ids:
                    continue

                seen_ids.add(bid)

                result.append({
                    "id": bid,
                    "title": item.get("title", ""),
                    "status_text": item.get("statusText", "open"),
                    "votes": item.get("votes", ""),
                    "game": item.get("game", ""),
                    "category": item.get("category", ""),
                    "date": item.get("date", ""),
                    "detail_url": BGA_BUG_URL.format(bug_id=bid),
                })

            return result

        bugs.extend(normalise_rows(page.evaluate(extract_js)))
        browser.close()

    return bugs

def ensure_labels(repo, status_texts):
    required = {LABEL_BGA: ("B60205", "Bug imported from Board Game Arena")}

    for status_text in status_texts:
        name, color, desc = resolve_status_label(status_text)
        required[name] = (color, desc)

    existing = {lbl.name for lbl in repo.get_labels()}

    for name, (color, desc) in required.items():
        if name not in existing:
            repo.create_label(name=name, color=color, description=desc)

def load_existing_bga_issues(repo, game_id):
    existing = {}

    bug_id_pattern = re.compile(r"\*\*BGA Bug ID:\*\*\s*`([^`]+)`")

    for issue in repo.get_issues(state="all"):
        labels = {label.name for label in issue.labels}

        if LABEL_BGA not in labels:
            continue

        match = bug_id_pattern.search(issue.body or "")
        if not match:
            continue

        bug_id = match.group(1)
        existing[f"bga_{game_id}_{bug_id}"] = issue

    log.info("Loaded %d previously synced BGA issue(s)", len(existing))
    return existing

def build_issue_body(bug):
    return "\n".join([
        f"**BGA Bug ID:** `{bug['id']}`",
        f"**Game:** {bug['game'] or 'unknown'}",
        f"**Category:** {bug['category'] or 'unknown'}",
        f"**Status on BGA:** {bug['status_text']}",
        f"**Votes:** {bug['votes'] or '0'}",
        f"**Reported:** {bug['date'] or 'unknown'}",
        "",
        f"**Link:** {bug['detail_url']}",
        "",
        "---",
        "_This issue was automatically imported by the BGA Bug Sync GitHub Action._",
    ])

def main():
    game_id = os.environ.get("BGA_GAME_ID", "1909")
    gh_token = os.environ.get("GITHUB_TOKEN", "")
    gh_repo = os.environ.get("GITHUB_REPO", "")

    if not gh_token or not gh_repo:
        sys.exit(1)

    bugs = fetch_bugs(game_id)

    gh = Github(gh_token)
    repo = gh.get_repo(gh_repo)

    ensure_labels(repo, {bug["status_text"] for bug in bugs})

    existing_issues = load_existing_bga_issues(repo, game_id)

    created = updated = skipped = 0

    for bug in bugs:
        bug_key = f"bga_{game_id}_{bug['id']}"
        status_label_name = resolve_status_label(bug["status_text"])[0]

        if bug_key in existing_issues:
            issue = existing_issues[bug_key]

            try:
                current_labels = {lbl.name for lbl in issue.labels}
                current_status = current_labels & ALL_STATUS_LABEL_NAMES

                if current_status != {status_label_name}:
                    new_labels = (
                        current_labels - ALL_STATUS_LABEL_NAMES
                    ) | {status_label_name}

                    issue.edit(labels=list(new_labels))
                    updated += 1
                else:
                    skipped += 1

            except GithubException as exc:
                log.warning("Could not update issue #%d: %s", issue.number, exc)

            continue

        title = f"[BGA #{bug['id']}] {bug['title']}"
        body = build_issue_body(bug)
        labels = [LABEL_BGA, status_label_name]

        try:
            issue = repo.create_issue(
                title=title,
                body=body,
                labels=labels,
            )

            existing_issues[bug_key] = issue
            created += 1
            time.sleep(0.5)

        except GithubException as exc:
            log.error("Failed to create issue for %s: %s", bug_key, exc)

    log.info(
        "Done — created: %d, updated: %d, skipped: %d.",
        created,
        updated,
        skipped,
    )

if __name__ == "__main__":
    main()
