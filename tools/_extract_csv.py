"""One-shot: convert every deck in Decktest_for_BGA.csv into PHP-array form,
plus a companion JS file mapping each hero constant to its CSV description."""
import csv
import sys
from pathlib import Path

HERE = Path(__file__).resolve().parent
sys.path.insert(0, str(HERE))
from deck_converter import (  # noqa: E402
    convert,
    find_cards_dir,
    hero_constant,
    load_uid_map,
)

CSV_PATH = HERE / "Decktest_for_BGA.csv"
OUT_PATH = HERE / "Decktest_for_BGA.txt"
DESC_PATH = HERE / "Decktest_for_BGA_hero_desc.js"
BUILDER_PATH = HERE / "Decktest_for_BGA_hero_deckbuilder.js"


def escape_js_single_quoted(s: str) -> str:
    """Escape a Python string for embedding in a JS single-quoted literal."""
    s = s.replace("\\", "\\\\")
    s = s.replace("'", "\\'")
    s = s.replace("\r\n", "\\n")
    s = s.replace("\r", "\\n")
    s = s.replace("\n", "\\n")
    return s

cards_dir = find_cards_dir(HERE)
uid_map = load_uid_map(cards_dir / "cards.inc.php")

with CSV_PATH.open(encoding="cp1252", newline="") as f:
    reader = csv.reader(f, delimiter=";")
    next(reader)  # header
    rows = [r for r in reader if any(c.strip() for c in r)]

out_lines: list[str] = []
desc_entries: list[tuple[str, str]] = []  # (constant, description)
builder_entries: list[tuple[str, str]] = []  # (constant, builder_name)
issues: list[str] = []

for idx, row in enumerate(rows, 1):
    name = row[0].strip()
    hero_label = row[1].strip() if len(row) > 1 else ""
    description = row[3].strip() if len(row) > 3 else ""
    cards_text = row[4] if len(row) > 4 else ""
    result = convert(cards_text, uid_map, cards_dir)

    header = f"// #{idx:02d}  {hero_label}  —  by {name}"
    info = (
        f"//        cards (excl. token) = {result['deck_card_count']}"
        + (" ⚠ <40" if result["deck_card_count"] < 40 else "")
    )
    if result["unknown"]:
        info += f"  |  unknown UIDs: {', '.join(result['unknown'])}"
        issues.append(f"#{idx:02d} {hero_label}: unknown {result['unknown']}")
    if not result["hero"]:
        info += "  |  ⚠ no hero detected"
        issues.append(f"#{idx:02d} {hero_label}: no hero detected")

    out_lines.append(header)
    out_lines.append(info)
    out_lines.append(result["output"])
    out_lines.append("")

    if result["hero"]:
        constant = hero_constant(result["hero"][2])
        desc_entries.append((constant, description))
        builder_entries.append((constant, name))

OUT_PATH.write_text("\n".join(out_lines), encoding="utf-8")
print(f"Wrote {OUT_PATH}  ({len(rows)} decks)")

desc_lines = ["const HERO_DESC = {"]
for constant, description in desc_entries:
    text = escape_js_single_quoted(description) if description else "PUT CONTENT THERE"
    desc_lines.append(f"  {constant}: _('{text}'),")
desc_lines.append("};")
desc_lines.append("")
DESC_PATH.write_text("\n".join(desc_lines), encoding="utf-8")
print(f"Wrote {DESC_PATH}  ({len(desc_entries)} entries)")

builder_lines = ["const HERO_DECKBUILDER = {"]
for constant, builder in builder_entries:
    text = escape_js_single_quoted(builder) if builder else "PUT CONTENT THERE"
    builder_lines.append(f"  {constant}: _('{text}'),")
builder_lines.append("};")
builder_lines.append("")
BUILDER_PATH.write_text("\n".join(builder_lines), encoding="utf-8")
print(f"Wrote {BUILDER_PATH}  ({len(builder_entries)} entries)")

if issues:
    print("\nIssues:")
    for line in issues:
        print(" -", line)
else:
    print("No issues.")
