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
import json
import sys
import time
import logging
from pathlib import Path

from playwright.sync_api import sync_playwright, TimeoutError as PlaywrightTimeout
from github import Github, GithubException

# ── Logging ───────────────────────────────────────────────────────────────────
logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s [%(levelname)s] %(message)s",
    datefmt="%Y-%m-%d %H:%M:%S",
)
log = logging.getLogger(__name__)

# ── Constants ─────────────────────────────────────────────────────────────────
BGA_BUGS_URL = (
    "https://boardgamearena.com/bugs?game={game_id}"
    "&statuses=open,infoneeded,confirmed,awaiting,inforequest,acknowledged,implemented,rejected"
)
BGA_BUG_URL = "https://boardgamearena.com/bug?id={bug_id}"

LABEL_BGA   = "bga-bug"
DEDUPE_FILE = ".bga_synced_bugs.json"

# JS file is next to this script
EXTRACT_JS_PATH = Path(__file__).parent / "extract_bugs.js"

# Map BGA status text (lowercased substring) → (label_name, color, description)
BGA_STATUS_LABELS = {
    "confirmed":      ("bga-confirmed",     "0075ca", "BGA status: Confirmed"),
    "confirme":       ("bga-confirmed",     "0075ca", "BGA status: Confirmed"),
}

ALL_STATUS_LABEL_NAMES = {v[0] for v in BGA_STATUS_LABELS.values()}


# ── Status helpers ────────────────────────────────────────────────────────────
def normalise_str(s):
    """Lowercase + strip accents for robust matching."""
    replacements = {"é": "e", "è": "e", "ê": "e", "à": "a", "î": "i", "ô": "o", "û": "u"}
    s = s.lower()
    for src, dst in replacements.items():
        s = s.replace(src, dst)
    return s


def resolve_status_label(status_text: str) -> tuple:
    """Return (label_name, color, description) for a BGA status string."""
    normalised = normalise_str(status_text)
    for key, value in BGA_STATUS_LABELS.items():
        if key in normalised:
            return value
    # Unknown status — create a generic label
    slug = normalised.replace(" ", "-")
    return (f"bga-{slug}", "ededed", f"BGA status: {status_text}")


# ── BGA scraper (Playwright) ──────────────────────────────────────────────────
def fetch_bugs(game_id: str) -> list:
    url = BGA_BUGS_URL.format(game_id=game_id)
    log.info("Opening %s with headless Chromium...", url)

    extract_js = EXTRACT_JS_PATH.read_text(encoding="utf-8")
    bugs = []

    with sync_playwright() as p:
        browser = p.chromium.launch(headless=True)
        context = browser.new_context(
            user_agent=(
                "Mozilla/5.0 (X11; Linux x86_64) "
                "AppleWebKit/537.36 (KHTML, like Gecko) "
                "Chrome/124.0 Safari/537.36"
            ),
            locale="en-US",
        )
        page = context.new_page()
        page.goto(url, wait_until="networkidle", timeout=60_000)

        try:
            page.wait_for_selector("tr.cursor-pointer", timeout=30_000)
        except PlaywrightTimeout:
            log.warning("Timed out waiting for bug rows — page structure may have changed.")
            log.debug(page.content()[:5000])
            browser.close()
            return bugs

        page.evaluate("window.scrollTo(0, document.body.scrollHeight)")
        time.sleep(2)

        seen_ids = set()

        def normalise_rows(items):
            result = []
            for item in items:
                bid = item.get("bugId") or "hash_{}".format(abs(hash(item.get("title", ""))))
                if not item.get("title") or bid in seen_ids:
                    continue
                seen_ids.add(bid)
                result.append({
                    "id":          bid,
                    "title":       item.get("title", ""),
                    "status_text": item.get("statusText", "open"),
                    "votes":       item.get("votes", ""),
                    "game":        item.get("game", ""),
                    "category":    item.get("category", ""),
                    "date":        item.get("date", ""),
                    "detail_url":  BGA_BUG_URL.format(bug_id=bid),
                })
            return result

        bugs.extend(normalise_rows(page.evaluate(extract_js)))
        log.info("Page 1: %d bug(s) found", len(bugs))

        page_num = 2
        while True:
            next_btn = page.query_selector(
                "a[rel='next'], "
                "button[aria-label='Next'], "
                ".pagination .next:not(.disabled), "
                "a[aria-label='Next page']"
            )
            if not next_btn:
                break
            log.info("Loading page %d...", page_num)
            next_btn.click()
            try:
                page.wait_for_load_state("networkidle", timeout=15_000)
                page.wait_for_selector("tr.cursor-pointer", timeout=10_000)
            except PlaywrightTimeout:
                break
            new_items = normalise_rows(page.evaluate(extract_js))
            if not new_items:
                break
            bugs.extend(new_items)
            log.info("Page %d: +%d bug(s)", page_num, len(new_items))
            page_num += 1

        browser.close()

    log.info("Total bugs fetched: %d", len(bugs))
    return bugs


# ── GitHub helpers ────────────────────────────────────────────────────────────
def ensure_labels(repo, status_texts):
    required = {LABEL_BGA: ("B60205", "Bug imported from Board Game Arena")}
    for status_text in status_texts:
        name, color, desc = resolve_status_label(status_text)
        required[name] = (color, desc)

    existing = {lbl.name for lbl in repo.get_labels()}
    for name, (color, desc) in required.items():
        if name not in existing:
            repo.create_label(name=name, color=color, description=desc)
            log.info("Created label: %s", name)


def load_synced(path):
    if os.path.exists(path):
        with open(path) as f:
            return json.load(f)
    return {}


def save_synced(path, data):
    with open(path, "w") as f:
        json.dump(data, f, indent=2)


def build_issue_body(bug):
    lines = [
        "**BGA Bug ID:** `{}`".format(bug["id"]),
        "**Game:** {}".format(bug["game"] or "unknown"),
        "**Category:** {}".format(bug["category"] or "unknown"),
        "**Status on BGA:** {}".format(bug["status_text"]),
        "**Votes:** {}".format(bug["votes"] or "0"),
        "**Reported:** {}".format(bug["date"] or "unknown"),
        "",
        "**Link:** {}".format(bug["detail_url"]),
        "",
        "---",
        "_This issue was automatically imported by the BGA Bug Sync GitHub Action._",
    ]
    return "\n".join(lines)


# ── Main ──────────────────────────────────────────────────────────────────────
def main():
    game_id  = os.environ.get("BGA_GAME_ID", "1909")
    gh_token = os.environ.get("GITHUB_TOKEN", "")
    gh_repo  = os.environ.get("GITHUB_REPO", "")

    missing = [k for k, v in {"GITHUB_TOKEN": gh_token, "GITHUB_REPO": gh_repo}.items() if not v]
    if missing:
        log.error("Missing required environment variables: %s", ", ".join(missing))
        sys.exit(1)

    bugs = fetch_bugs(game_id)
    if not bugs:
        log.info("No bugs found — nothing to sync.")
        return

    gh   = Github(gh_token)
    repo = gh.get_repo(gh_repo)

    all_statuses = {bug["status_text"] for bug in bugs}
    ensure_labels(repo, all_statuses)

    synced = load_synced(DEDUPE_FILE)
    created = updated = skipped = 0

    for bug in bugs:
        bug_key           = "bga_{}_{}".format(game_id, bug["id"])
        status_label_name = resolve_status_label(bug["status_text"])[0]

        if bug_key in synced:
            try:
                issue          = repo.get_issue(synced[bug_key])
                current_labels = {lbl.name for lbl in issue.labels}
                current_status = current_labels & ALL_STATUS_LABEL_NAMES

                if current_status != {status_label_name}:
                    new_labels = (current_labels - ALL_STATUS_LABEL_NAMES) | {status_label_name}
                    issue.edit(labels=list(new_labels))
                    log.info("Updated label on issue #%d -> %s", issue.number, status_label_name)
                    updated += 1
                else:
                    skipped += 1
            except GithubException as exc:
                log.warning("Could not update %s: %s", bug_key, exc)
            continue

        title  = "[BGA #{}] {}".format(bug["id"], bug["title"])
        body   = build_issue_body(bug)
        labels = [LABEL_BGA, status_label_name]

        try:
            issue           = repo.create_issue(title=title, body=body, labels=labels)
            synced[bug_key] = issue.number
            log.info("Created issue #%d: %s", issue.number, title[:70])
            created += 1
            time.sleep(0.5)
        except GithubException as exc:
            log.error("Failed to create issue for %s: %s", bug_key, exc)

    save_synced(DEDUPE_FILE, synced)
    log.info("Done — created: %d, updated: %d, skipped: %d.", created, updated, skipped)


if __name__ == "__main__":
    main()
