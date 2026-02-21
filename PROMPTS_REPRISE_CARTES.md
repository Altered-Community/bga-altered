# Prompts de reprise prêts à l’emploi

## Prompt 1 – Batch non-Feat

"Implémente les cartes AX ROC non-Feat restantes dans `altered/modules/php/Cards/AX`. Utilise `effectDesc` comme source de vérité, les patterns de `altered/CARD_EFFECTS_RUNBOOK.md`, n’implémente pas les placeholders, puis valide les erreurs PHP uniquement sur les fichiers touchés. Mets à jour `altered/ROC_AX_PROGRESS_TRACKER.md`."

## Prompt 2 – Une seule carte

"Implémente uniquement la carte `[NOM]` dans `[FICHIER]` en mappant strictement `effectDesc`/`supportDesc`. Pas de refacto large. Valide diagnostics PHP du fichier et mets une note dans le tracker."

## Prompt 3 – Audit avant implémentation

"Audit les cartes AX ROC avec `effectDesc` non câblé (`effect*` manquants) et classe par priorité (facile/moyen/complexe). Ne modifie pas le code, produis seulement la liste dans `altered/ROC_AX_PROGRESS_TRACKER.md`."

## Prompt 4 – Passe qualité

"Vérifie les cartes AX ROC marquées DONE: cohérence texte->code, trigger passif `EndTurn`, et absence d’effets contradictoires. Corrige uniquement les écarts évidents et relance diagnostics PHP ciblés."
