"""
Altered Deck Converter
======================
GUI tool that converts a deck list in UID form like:

    1 ALT_CYCLONE_B_MU_65_C
    3 ALT_CYCLONE_B_YZ_72_R2
    ...

into the PHP-array form expected by the Altered BGA project, e.g.:

    KAURI_PUFF = [
        'MU_Common_KauriPuff' => 1,
        ...
        // TOKEN
        'MU_Common_Woollyback' => 1,
      ],

It reads `modules/php/Cards/cards.inc.php` to map UID -> CardClass,
then opens the hero file to detect any INVOKE_TOKEN tokenType.

Run:         python tools/deck_converter.py
Build exe:   pip install pyinstaller
             pyinstaller --onefile --windowed --name AlteredDeckConverter tools/deck_converter.py
"""

import json
import os
import re
import sys
import tkinter as tk
from pathlib import Path
from tkinter import filedialog, messagebox, scrolledtext, ttk

CONFIG_FILE = Path.home() / ".altered_deck_converter.json"

UID_LINE_RE = re.compile(
    r"'(ALT_[A-Z0-9_]+)'\s*=>\s*'([A-Za-z0-9]+)/([A-Za-z0-9_]+)'"
)
DECK_LINE_RE = re.compile(r"^\s*(\d+)\s+(ALT_[A-Z0-9_]+)\s*$")
TOKEN_TYPE_RE = re.compile(r"'tokenType'\s*=>\s*'([^']+)'")
HERO_TYPE_RE = re.compile(r"'type'\s*=>\s*HERO\b")
LINE_COMMENT_RE = re.compile(r"//[^\n]*")
BLOCK_COMMENT_RE = re.compile(r"/\*.*?\*/", re.DOTALL)


def strip_php_comments(text: str) -> str:
    text = BLOCK_COMMENT_RE.sub("", text)
    text = LINE_COMMENT_RE.sub("", text)
    return text


def find_cards_dir(start: Path) -> Path | None:
    """Walk up from `start` looking for modules/php/Cards/cards.inc.php."""
    for base in [start, *start.parents]:
        candidate = base / "modules" / "php" / "Cards"
        if (candidate / "cards.inc.php").exists():
            return candidate
    return None


def load_uid_map(cards_inc: Path) -> dict[str, tuple[str, str]]:
    """Parse cards.inc.php into { uid: (folder, ClassName) }."""
    text = strip_php_comments(cards_inc.read_text(encoding="utf-8"))
    mapping: dict[str, tuple[str, str]] = {}
    for match in UID_LINE_RE.finditer(text):
        uid, folder, class_name = match.groups()
        mapping[uid] = (folder, class_name)
    return mapping


def card_file_path(cards_dir: Path, folder: str, class_name: str) -> Path:
    return cards_dir / folder / f"{class_name}.php"


def is_hero_file(card_path: Path) -> bool:
    if not card_path.exists():
        return False
    try:
        text = strip_php_comments(card_path.read_text(encoding="utf-8"))
    except OSError:
        return False
    return bool(HERO_TYPE_RE.search(text))


def hero_tokens(card_path: Path) -> list[str]:
    """Return tokenType values declared inside any INVOKE_TOKEN block."""
    if not card_path.exists():
        return []
    text = strip_php_comments(card_path.read_text(encoding="utf-8"))
    if "INVOKE_TOKEN" not in text:
        return []
    seen: list[str] = []
    for m in TOKEN_TYPE_RE.finditer(text):
        token = m.group(1)
        if token not in seen:
            seen.append(token)
    return seen


def hero_constant(class_name: str) -> str:
    """e.g. 'MU_Common_KauriPuff' -> 'KAURI_PUFF'."""
    parts = class_name.split("_", 2)
    name = parts[2] if len(parts) >= 3 else class_name
    snake = re.sub(r"(?<=[a-z0-9])(?=[A-Z])", "_", name)
    snake = re.sub(r"(?<=[A-Z])(?=[A-Z][a-z])", "_", snake)
    return snake.upper()


def normalize_uid(uid: str) -> str:
    """Port of Cards::getMainUid() in modules/php/Managers/Cards.php.

    Remaps promo/event set codes to their canonical set and forces the
    edition slot to 'B'.
    """
    parts = uid.split("_")
    if len(parts) < 6:
        return uid
    set_code = parts[1]
    if set_code in ("DUSTEROP", "DUSTERCB", "DUSTERTOP"):
        try:
            number = int(parts[4])
        except ValueError:
            number = 0
        if number < 25:
            parts[1] = "CORE"
        elif number < 45:
            parts[1] = "ALIZE"
        else:
            parts[1] = "DUSTER"
    elif set_code == "TCS3":
        parts[1] = "BISE"
    elif set_code in ("WCQ25", "WCS25", "MUSUBI", "COREKS"):
        parts[1] = "CORE"
    parts[2] = "B"
    return "_".join(parts)


def parse_input(text: str) -> tuple[list[tuple[int, str]], list[str]]:
    """Return [(count, uid)] in source order plus a list of skipped lines."""
    entries: list[tuple[int, str]] = []
    skipped: list[str] = []
    for raw in text.splitlines():
        line = raw.strip()
        if not line:
            continue
        m = DECK_LINE_RE.match(line)
        if not m:
            skipped.append(raw)
            continue
        entries.append((int(m.group(1)), m.group(2)))
    return entries, skipped


def convert(text: str, uid_map: dict[str, tuple[str, str]], cards_dir: Path):
    entries, skipped = parse_input(text)

    resolved: list[tuple[int, str, str]] = []  # (count, folder, class_name)
    unknown: list[str] = []
    for count, uid in entries:
        # Prefer the UID as-is when it already exists (e.g. promo "_P_" cards
        # like ALT_ALIZE_P_OR_48_R1 must not be remapped to "_B_").
        hit = uid_map.get(uid) or uid_map.get(normalize_uid(uid))
        if hit is None:
            unknown.append(uid)
            continue
        folder, class_name = hit
        resolved.append((count, folder, class_name))

    hero_idx = None
    for i, (count, folder, class_name) in enumerate(resolved):
        if is_hero_file(card_file_path(cards_dir, folder, class_name)):
            hero_idx = i
            break

    hero = resolved.pop(hero_idx) if hero_idx is not None else None
    tokens = (
        hero_tokens(card_file_path(cards_dir, hero[1], hero[2])) if hero else []
    )

    constant = hero_constant(hero[2]) if hero else "DECK"
    # "Cards without the token" = hero + all other deck cards, excluding tokens.
    deck_card_count = sum(c for c, _, _ in resolved) + (hero[0] if hero else 0)

    out_lines = [f"  {constant} = ["]
    if hero:
        out_lines.append(f"    '{hero[2]}' => {hero[0]},")
    for count, _folder, class_name in resolved:
        out_lines.append(f"    '{class_name}' => {count},")
    if tokens:
        out_lines.append(f"    // TOKEN")
        for token in tokens:
            out_lines.append(f"    '{token}' => 1,")
    out_lines.append("  ],")

    return {
        "output": "\n".join(out_lines),
        "deck_card_count": deck_card_count,
        "hero": hero,
        "tokens": tokens,
        "unknown": unknown,
        "skipped": skipped,
    }


def load_config() -> dict:
    if CONFIG_FILE.exists():
        try:
            return json.loads(CONFIG_FILE.read_text(encoding="utf-8"))
        except (OSError, ValueError):
            pass
    return {}


def save_config(data: dict) -> None:
    try:
        CONFIG_FILE.write_text(json.dumps(data, indent=2), encoding="utf-8")
    except OSError:
        pass


class ConverterApp(tk.Tk):
    def __init__(self) -> None:
        super().__init__()
        self.title("Altered Deck Converter")
        self.geometry("1280x720")
        self.minsize(800, 500)

        self.cards_dir: Path | None = None
        self.uid_map: dict[str, tuple[str, str]] = {}

        self._build_ui()
        self._auto_load_cards_dir()

    def _build_ui(self) -> None:
        toolbar = tk.Frame(self)
        toolbar.pack(side=tk.TOP, fill=tk.X, padx=6, pady=4)

        ttk.Button(toolbar, text="Convert (Ctrl+Enter)", command=self.on_convert).pack(
            side=tk.LEFT
        )
        ttk.Button(
            toolbar, text="Pick cards.inc.php…", command=self.on_pick_cards_dir
        ).pack(side=tk.LEFT, padx=(8, 0))
        ttk.Button(toolbar, text="Copy output", command=self.on_copy).pack(
            side=tk.LEFT, padx=(8, 0)
        )

        self.status_var = tk.StringVar(value="No cards.inc.php loaded yet.")
        tk.Label(
            toolbar, textvariable=self.status_var, anchor="w", fg="#444"
        ).pack(side=tk.LEFT, padx=12, fill=tk.X, expand=True)

        self.summary_var = tk.StringVar(value="")
        tk.Label(
            self, textvariable=self.summary_var, anchor="w", fg="#0a52a3",
            font=("Segoe UI", 10, "bold"),
        ).pack(side=tk.TOP, fill=tk.X, padx=10, pady=(0, 4))

        paned = ttk.PanedWindow(self, orient=tk.HORIZONTAL)
        paned.pack(fill=tk.BOTH, expand=True, padx=6, pady=(0, 6))

        left = ttk.LabelFrame(paned, text="Input — one line per card: <count> <UID>")
        self.input_text = scrolledtext.ScrolledText(
            left, wrap=tk.NONE, font=("Consolas", 11), undo=True
        )
        self.input_text.pack(fill=tk.BOTH, expand=True)
        paned.add(left, weight=1)

        right = ttk.LabelFrame(paned, text="Output — paste into cards.inc.php")
        self.output_text = scrolledtext.ScrolledText(
            right, wrap=tk.NONE, font=("Consolas", 11)
        )
        self.output_text.pack(fill=tk.BOTH, expand=True)
        paned.add(right, weight=1)

        self.bind("<Control-Return>", lambda _e: self.on_convert())

    def _auto_load_cards_dir(self) -> None:
        cfg = load_config()
        saved = cfg.get("cards_dir")
        if saved and (Path(saved) / "cards.inc.php").exists():
            self._set_cards_dir(Path(saved))
            return
        # Try near the script first, then near the executable / cwd.
        bases = [Path(__file__).resolve().parent, Path.cwd()]
        if getattr(sys, "frozen", False):
            bases.append(Path(sys.executable).resolve().parent)
        for base in bases:
            found = find_cards_dir(base)
            if found:
                self._set_cards_dir(found)
                return
        self.status_var.set(
            "Could not auto-detect cards.inc.php — use 'Pick cards.inc.php…'."
        )

    def _set_cards_dir(self, cards_dir: Path) -> None:
        try:
            uid_map = load_uid_map(cards_dir / "cards.inc.php")
        except OSError as exc:
            messagebox.showerror("Error", f"Failed to read cards.inc.php:\n{exc}")
            return
        self.cards_dir = cards_dir
        self.uid_map = uid_map
        save_config({"cards_dir": str(cards_dir)})
        self.status_var.set(
            f"Loaded {len(uid_map)} UIDs from {cards_dir / 'cards.inc.php'}"
        )

    def on_pick_cards_dir(self) -> None:
        path = filedialog.askopenfilename(
            title="Locate cards.inc.php",
            filetypes=[("PHP files", "*.php"), ("All files", "*.*")],
            initialfile="cards.inc.php",
        )
        if not path:
            return
        cards_dir = Path(path).parent
        if not (cards_dir / "cards.inc.php").exists():
            messagebox.showerror("Error", "Selected file is not cards.inc.php.")
            return
        self._set_cards_dir(cards_dir)

    def on_copy(self) -> None:
        text = self.output_text.get("1.0", tk.END).rstrip("\n")
        if not text:
            return
        self.clipboard_clear()
        self.clipboard_append(text)
        self.status_var.set("Output copied to clipboard.")

    def on_convert(self) -> None:
        if not self.cards_dir:
            messagebox.showerror(
                "No cards directory",
                "Locate cards.inc.php first via 'Pick cards.inc.php…'.",
            )
            return
        text = self.input_text.get("1.0", tk.END)
        try:
            result = convert(text, self.uid_map, self.cards_dir)
        except Exception as exc:  # surface unexpected parsing errors in the UI
            messagebox.showerror("Conversion error", str(exc))
            return

        self.output_text.delete("1.0", tk.END)
        self.output_text.insert("1.0", result["output"])

        parts = [f"Cards without token: {result['deck_card_count']}"]
        if result["deck_card_count"] < 40:
            parts.append("⚠ less than 40")
        else:
            parts.append("≥ 40 ✓")
        if result["hero"]:
            parts.append(f"hero: {result['hero'][2]}")
        else:
            parts.append("⚠ no hero detected")
        if result["tokens"]:
            parts.append("token(s): " + ", ".join(result["tokens"]))
        if result["unknown"]:
            parts.append(f"unknown UIDs: {len(result['unknown'])}")
        if result["skipped"]:
            parts.append(f"skipped lines: {len(result['skipped'])}")
        self.summary_var.set("  |  ".join(parts))

        if result["unknown"]:
            messagebox.showwarning(
                "Unknown UIDs",
                "These UIDs were not found in cards.inc.php:\n\n"
                + "\n".join(result["unknown"]),
            )


def main() -> None:
    app = ConverterApp()
    app.mainloop()


if __name__ == "__main__":
    main()
