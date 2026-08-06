# Card frame sprites (faction PNG + CSS)

Faction card frames are **one PNG sprite per faction** (`img/frames/<FACTION>.png`). The in-game frame is a `.card-frame` div with `background-image` and `background-position` chosen from `data-type`, `data-rarity`, `data-support`, and `data-size` on that element (see `modules/css/cards.scss`).

Factions are listed in `modules/css/variables.scss` as `$factions` (currently **AX, BR, LY, MU, NE, OD, YZ**). Each needs a matching PNG unless you change that list.

---

## Step 1 — Edit the GIMP sources (`.xcf`)

1. Open each faction’s `.xcf` (one working file per faction, typically aligned with the exported `img/frames/<FACTION>.png` layout).
2. **Add or rearrange frame cells** so every combination you need exists on the sprite grid (same grid for every faction so CSS stays shared).

### Step 1-2 — `.card-frame` `background-size`

Default in `cards.scss`:

```scss
background-size: 600% 800%;
```

- **Width (first value):** keep **`600%`** for a **6-column** sprite (one column per visual step from left to right on the sheet).
- **Height (second value):** set to **`number_of_rows * 100%`**. Example: **8 rows → `800%`**. If you add a ninth horizontal strip of frames, use **`900%`**, and so on.

After changing the vertical size, **every `background-position` percentage on that sprite must be revalidated** (see Step 3).

### Step 1-3 — GIMP: Display / update guide lines

Use guidelines to place elements properly: Go to Images / Guides / Add new Guide (in percentage). 
THen go to View (Affichage), and ensure that Show Guides (Afficher les Guides) and Snap to Guides (Aligner sur les Guides) are checked
If you need to update existing guide lines, select a guide you want to remove and drag&drop it out of the screen, then create the new one.

Warning: Guides have been created only after ROC. The older placement frames have not been modified, to prevent unwanted behavior.


### Step 1-4 — GIMP: Move (**M**)

Use **Move (M)** and **Align (Q)** so new frames line up with existing rows/columns (same cell size and offsets as the rest of the sheet) and guidelines. Consistent alignment keeps `background-position` predictable across factions.

### Step 1-4 — Export and compress

1. Export each faction sheet to PNG (flat image, no layers needed in game).
2. Run exports through [TinyPNG](https://tinypng.com/) (or equivalent) to shrink file size before committing assets.

---

## Step 2 — Revise `background-position` in SCSS

Edit **`modules/css/cards.scss`** inside `.altered-card .altered-card-wrapper .card-frame`.

1. Walk **every `data-type`** you use (`hero`, `token`, `character`, `spell`, `permanent`, `gear`, `feat`, …).
2. For each type, adjust **`background-position: X% Y%`** so the visible cell matches the new art. Nested selectors use **`data-rarity`**, **`data-support`**, **`data-size`** (and sometimes **`data-landmark`** for feats) — mirror whatever the PHP/templates emit on `.card-frame`.
3. **Add new rule blocks** when you introduce a new combination (e.g. a new type or rarity band).

The sprite math is **not always a uniform grid** in this project (some rows use intermediate Y values like `50%`). Treat percentages as **empirical**: derive them from the exported PNG layout after `background-size` is fixed.

---

## Step 3 — Regenerate the compiled CSS

From the **repository root** (where `altered.scss` lives), compile entry **`altered.scss`** to **`nylaltered.css`**:

```bash
npx sass altered.scss nylaltered.css
```

Optional source map (this repo already has `nylaltered.css.map`):

```bash
npx sass altered.scss nylaltered.css --source-map
```

Requires [Dart Sass](https://sass-lang.com/install/) available via `npx` or globally as `sass`.

---

## Step 4 — Copy artifacts into the game tree

For this project, keep paths consistent with imports in `altered.scss` and `cards.scss`:

| Artifact | Typical location |
|----------|------------------|
| Compiled stylesheet | **`nylaltered.css`** (repo root; same folder as `altered.scss`) |
| Source SCSS | **`modules/css/cards.scss`** (and other partials if you touched them) |
| Frame PNGs | **`img/frames/<FACTION>.png`** |

If your deployment or BGA packaging expects a different root CSS filename (e.g. a template named `project.css`), **copy or rename** there as part of your publish step — the authoritative compile output here is **`nylaltered.css`**.

---

## Quick reference: current sprite baseline

| Setting | Value | Meaning |
|--------|-------|---------|
| `background-size` | `600% 800%` | 6 columns × 8 rows (in “CSS sprite” scaling) |
| Faction files | `img/frames/{AX,BR,LY,MU,NE,OD,YZ}.png` | From `$factions` + `cards.scss` `@each` |

After any change to row/column count or cell arrangement, repeat Steps 2–4 before testing in the browser.
