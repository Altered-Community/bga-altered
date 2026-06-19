#!/usr/bin/env python3
"""
Rename the BGA-style game slug (root PHP/JS/CSS/TPL entrypoints + Core/Game.php)
and optionally swap ``gameoptions.json`` for an environment-specific version.

Mirrors the file renames and in-file edits from commit e4c4d654c9a506954892ed20a77be9e959c2fc57
("rename altered -> alteredpreprod")

Options:
  --target TARGET
    New game slug (e.g. alteredpreprod). Must be a valid PHP identifier.
    When ``gameoptions.{TARGET}.json`` (or a mapped stem from
    ``_ENV_GAMEOPTIONS_MAP``) exists, it replaces ``gameoptions.json``
    so per-environment options (e.g. deck formats) are deployed.
  --dry-run
    Print actions without modifying files.
  --source SOURCE
    Current game slug. Optional, will be auto-detected if omitted.
    Can be used to override auto-detection for extra safety.

Examples:
  # Dry run: print actions without modifying files.
  python misc/python-tools/rename-game-slug.py --dry-run --target taumaltered

  # Auto-detect source slug from repo root.
  python misc/python-tools/rename-game-slug.py --target alteredpreprod
"""

from __future__ import annotations

import argparse
import re
import shutil
import sys
from pathlib import Path


def _php_identifier(s: str) -> bool:
    return bool(re.fullmatch(r"[A-Za-z_][A-Za-z0-9_]*", s))


def _slug_bundle_filenames(slug: str) -> tuple[str, ...]:
    """Root-relative names that define a BGA-style slug (same set as e4c4d65)."""
    return (
        f"{slug}.action.php",
        f"{slug}.css",
        f"{slug}.game.php",
        f"{slug}.js",
        f"{slug}.scss",
        f"{slug}.view.php",
        f"{slug}_{slug}.tpl",
    )


def _root_moves(source: str, target: str) -> list[tuple[str, str]]:
    src = _slug_bundle_filenames(source)
    dst = _slug_bundle_filenames(target)
    return list(zip(src, dst))


def detect_source_slug(repo: Path) -> str:
    """
    Infer slug from repo root: any *.game.php whose stem matches the full
    entrypoint bundle (action/css/game/js/scss/view/tpl).

    Note: Path('x.game.php').stem is 'x.game', not 'x'; we strip '.game.php' explicitly.
    """
    candidates: list[str] = []
    for p in repo.iterdir():
        if not p.is_file():
            continue
        name = p.name
        if not name.endswith(".game.php"):
            continue
        slug = name[: -len(".game.php")]
        if not slug or not _php_identifier(slug):
            continue
        if all((repo / fn).is_file() for fn in _slug_bundle_filenames(slug)):
            candidates.append(slug)

    candidates = sorted(set(candidates))
    if not candidates:
        raise ValueError(
            f"could not infer source slug under {repo}: "
            "no *.game.php with matching "
            ".action.php, .css, .js, .scss, .view.php, and {{slug}}_{{slug}}.tpl"
        )
    if len(candidates) > 1:
        raise ValueError(
            "ambiguous source slug: multiple full entrypoint bundles found: "
            + ", ".join(repr(s) for s in candidates)
            + ". Pass --source explicitly."
        )
    return candidates[0]


def _transform_action_php(content: str, source: str, target: str) -> str:
    content = content.replace(
        f"class action_{source} extends",
        f"class action_{target} extends",
    )
    content = content.replace(
        f"$this->view = '{source}_{source}';",
        f"$this->view = '{target}_{target}';",
    )
    return content


def _transform_game_php(content: str, source: str, target: str) -> str:
    content = content.replace(
        f"class {source} extends Table",
        f"class {target} extends Table",
    )
    content = content.replace(
        f"return '{source}';",
        f"return '{target}';",
    )
    return content


def _transform_view_php(content: str, source: str, target: str) -> str:
    content = content.replace(
        f"class view_{source}_{source} extends",
        f"class view_{target}_{target} extends",
    )
    content = content.replace(
        f"return '{source}';",
        f"return '{target}';",
    )
    return content


def _transform_js(content: str, source: str, target: str) -> str:
    # Same scope as e4c4d65: only the Dojo declare module id (not DOM ids / CSS classes).
    content = content.replace(
        f"declare('bgagame.{source}',",
        f"declare('bgagame.{target}',",
    )
    return content


def _transform_core_game_php(content: str, source: str, target: str) -> str:
    content = content.replace(f"use {source};", f"use {target};")
    content = content.replace(f"return {source}::get();", f"return {target}::get();")
    return content


_ENV_GAMEOPTIONS_MAP: dict[str, str] = {
    # Map target slug → environment-specific filename stem.
    # Multiple targets can share a single gameoptions.{stem}.json file.
    "alteredpreprod": "altered",
}


def _patch_gameoptions(repo: Path, target: str, dry_run: bool) -> None:
    """
    If a file ``gameoptions.{stem}.json`` (where *stem* is resolved via
    ``_ENV_GAMEOPTIONS_MAP`` or defaults to *target*) exists next to the
    base ``gameoptions.json``, copy it over the base file and remove the
    environment-specific copy so it does not leak to the deployment.

    Convention:
        gameoptions.altered.json      → production (altered) and alteredpreprod (alteredpreprod)
        gameoptions.json               → everything else (preprod, branches, …)
    """
    stem = _ENV_GAMEOPTIONS_MAP.get(target, target)
    env_path = repo / f"gameoptions.{stem}.json"
    target_path = repo / "gameoptions.json"
    if not env_path.is_file():
        return
    if not target_path.is_file():
        print(f"error: expected base {target_path} not found", file=sys.stderr)
        return
    if dry_run:
        print(f"copy {env_path.name} -> {target_path.name}")
        print(f"delete {env_path.name}")
    else:
        shutil.copy(env_path, target_path)
        env_path.unlink()


def _read_text(path: Path) -> str:
    return path.read_text(encoding="utf-8")


def _write_text(path: Path, content: str) -> None:
    path.write_text(content, encoding="utf-8", newline="\n")


def main() -> int:
    parser = argparse.ArgumentParser(
        description="Rename BGA game slug.",
    )
    parser.add_argument(
        "--source",
        default=None,
        metavar="SLUG",
        help="Current game slug / PHP class basename. "
        "If omitted, inferred from repo root (see *.game.php + matching entrypoints).",
    )
    parser.add_argument(
        "--target",
        default="alteredpreprod",
        help="New game slug (default: alteredpreprod).",
    )
    parser.add_argument(
        "--repo",
        type=Path,
        default=Path.cwd(),
        help="Repository root (default: current directory).",
    )
    parser.add_argument(
        "--dry-run",
        action="store_true",
        help="Print actions without modifying files.",
    )
    args = parser.parse_args()

    target: str = args.target
    repo: Path = args.repo.resolve()

    source_autodetected = False
    if args.source is None:
        try:
            source = detect_source_slug(repo)
        except ValueError as e:
            print(f"error: {e}", file=sys.stderr)
            return 2
        source_autodetected = True
    else:
        source = args.source

    if source_autodetected:
        print(f"detected --source {source!r} from files under {repo}")

    if source == target:
        print("error: --source and --target must differ", file=sys.stderr)
        return 2
    if not _php_identifier(source) or not _php_identifier(target):
        print(
            "error: --source and --target must be valid PHP identifiers "
            "(letters, digits, underscore; first char not a digit).",
            file=sys.stderr,
        )
        return 2

    # Root entrypoints from e4c4d65.
    root_moves = _root_moves(source, target)

    core_game = repo / "modules" / "php" / "Core" / "Game.php"

    for old_name, new_name in root_moves:
        old_path = repo / old_name
        new_path = repo / new_name
        if not old_path.is_file():
            print(f"error: missing expected file {old_path}", file=sys.stderr)
            return 1
        if new_path.exists():
            print(f"error: target already exists: {new_path}", file=sys.stderr)
            return 1

    if not core_game.is_file():
        print(f"error: missing {core_game}", file=sys.stderr)
        return 1

    def log(msg: str) -> None:
        print(msg)

    # --- apply ---
    for old_name, new_name in root_moves:
        old_path = repo / old_name
        new_path = repo / new_name
        if old_name.endswith(".action.php"):
            text = _transform_action_php(_read_text(old_path), source, target)
            if args.dry_run:
                log(f"write {new_path} (from {old_path.name} + transforms); delete {old_path}")
            else:
                _write_text(new_path, text)
                old_path.unlink()
        elif old_name.endswith(".game.php"):
            text = _transform_game_php(_read_text(old_path), source, target)
            if args.dry_run:
                log(f"write {new_path} (from {old_path.name} + transforms); delete {old_path}")
            else:
                _write_text(new_path, text)
                old_path.unlink()
        elif old_name.endswith(".view.php"):
            text = _transform_view_php(_read_text(old_path), source, target)
            if args.dry_run:
                log(f"write {new_path} (from {old_path.name} + transforms); delete {old_path}")
            else:
                _write_text(new_path, text)
                old_path.unlink()
        elif old_name.endswith(".js"):
            text = _transform_js(_read_text(old_path), source, target)
            if args.dry_run:
                log(f"write {new_path} (from {old_path.name} + transforms); delete {old_path}")
            else:
                _write_text(new_path, text)
                old_path.unlink()
        else:
            if args.dry_run:
                log(f"rename {old_path} -> {new_path}")
            else:
                shutil.move(str(old_path), str(new_path))

    cg_text = _read_text(core_game)
    cg_new = _transform_core_game_php(cg_text, source, target)
    if cg_new == cg_text:
        print(
            f"warning: {core_game} had no matching use/return lines for slug {source!r}",
            file=sys.stderr,
        )
    if args.dry_run:
        log(f"patch {core_game} (use + ::get() for {source!r} -> {target!r})")
    else:
        _write_text(core_game, cg_new)

    _patch_gameoptions(repo, target, args.dry_run)

    log("done.")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
