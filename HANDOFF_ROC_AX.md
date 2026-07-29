# Handoff – AX / ROC (effets cartes)

_Date: 2026-02-20 (mis à jour le 2026-02-21)_

## 0) Kit de reprise (nouveaux fichiers)

- Runbook: `altered/CARD_EFFECTS_RUNBOOK.md`
- Template carte: `altered/CARD_EFFECT_TEMPLATE.md`
- Tracker: `altered/ROC_AX_PROGRESS_TRACKER.md`
- Prompts prêts à l'emploi: `altered/PROMPTS_REPRISE_CARTES.md`

## 1) Contexte workspace

- Workspace multi-projets BGA (plusieurs jeux), mais le scope de travail ici est **`altered/modules/php`**.
- Les cartes ciblées sont dans **`modules/php/Cards/AX`**.
- Contrainte métier utilisée pendant l’implémentation: **ignorer les placeholders** et (au moment du travail) **ignorer les Feats**.

## 2) Architecture moteur d’effets (ce qu’il faut retenir)

- Les cartes déclarent des propriétés: `effectPlayed`, `effectHand`, `effectReserve`, `effectPassive`, `effectSupport`, `effectTap`.
- Les effets sont exprimés via `ALT\Helpers\FT` (`FT::ACTION`, `FT::SEQ`, `FT::SEQ_OPTIONAL`, `FT::SABOTAGE`, etc.).
- Les passifs écoutent des événements (action/type) et sont résolus via la chaîne Action -> listeners -> réactions carte.

### Trigger “quand tu passes”

- Le pass réel est routé via l’action **`EndTurn`** (pas une clé “Pass”).
- Pour un effet “When you pass…”, utiliser en pratique:
  - `effectPassive['EndTurn']`
  - conditions (`isMe`, `isHandEmpty`, etc.)

## 3) Conditions et extensions moteur ajoutées

### 3.1 Conditions ajoutées

Fichier: `modules/php/Helpers/Conditions.php`

- `hasXCardsInHand($n, $op='GTE')`
  - opérateurs gérés: `GTE`, `LTE`, `EQ`
- `hasNoTokensInLandmarks()`
  - vrai si aucun token dans la zone Landmarks du joueur

### 3.2 Limitation de jeu ajoutée

Fichier: `modules/php/Models/Card.php`

- Nouvelle valeur `playLimitation = 'singleCardHand'`
  - la carte n’est jouable que si la main contient au plus 1 carte
  - implémentée dans `getPlayableLocation()`

## 4) Patterns d’implémentation utiles (ROC AX)

- **Put card from hand in Reserve**
  - `FT::ACTION(TARGET, ['targetLocation' => [HAND], ... 'effect' => FT::DISCARD_TO_RESERVE()])`
- **SABOTAGE_INF / SABOTAGE_LOW**
  - réutiliser `FT::SABOTAGE()` (up to 1 carte en réserve)
- **Créer Aerolith**
  - `INVOKE_TOKEN` avec `tokenType => 'NE_Common_Aerolith'`, `targetLocation => [LANDMARK]`
- **Réduction coût “next Permanent this Afternoon”**
  - `SPECIAL_EFFECT` -> `costReduction` avec `['type'=>PERMANENT, 'reduction'=>1, ...]`
- **Activation des {j} d’un Permanent**
  - cible Permanent + `FT::ACTION(ACTIVATE_EFFECT, [])`

## 5) Pièges rencontrés

1. **Nommage des fichiers ROC**

- Certaines cartes attendues n’existent pas sous le nom intuitif (ex: variations de nom/type/suffixe).
- Toujours vérifier via recherche de fichier avant patch.

2. **Ne pas copier ROC -> ROC**

- Plusieurs cartes ROC sont stubs en parallèle; il faut mapper depuis `effectDesc` + patterns moteur existants.

3. **Play limitations limitées dans le moteur**

- `playLimitation` avait peu de valeurs nativement (`nonStartingRegion`, `+3StartingRegion`, etc.).
- D’où l’ajout de `singleCardHand`.

## 6) Cartes ROC AX (non-Feat) déjà travaillées pendant la session

- Sneaky Salamander (C/R)
- Toting Armadillo (C/R)
- Corrupted Paju (C/R)
- Reka Scavenger (R) + Common traité auparavant
- Hop-o’-my-Thumb (C/R)
- Shiramun, Tech Monk (C/R)
- Reka Recycler (C/R)
- Reka Welder (C/R)
- Frankenstein’s Creature (C/R)
- Master Lapidary (R)
- Stigma of Stagnation (C/R)
- Inari, Spirit of Industry (C/R)
- Emergency Burst (C/R)
- A Pebble in the Pond (C/R)

> Note: il y a eu des annulations/retouches utilisateur en cours de route. Faire une passe de validation de chaque fichier avant finalisation.

## 7) État minimal à vérifier en reprise

1. Que `Conditions.php` contient bien `hasXCardsInHand` et `hasNoTokensInLandmarks`.
2. Que `Card.php` contient bien la branche `playLimitation == 'singleCardHand'`.
3. Que les cartes ROC ciblées ont les bons blocs `effect*` (et pas seulement `effectDesc`).
4. Lancer diagnostics PHP sur la liste de fichiers modifiés.

## 8) Erreurs/alertes déjà vues

- Erreurs de constante subtype `CORRUPTION` ont été vues sur certaines cartes (stubs existants) selon l’état du moment.
- Ne pas traiter ces erreurs “globales” hors scope sans confirmation produit (certaines sont pré-existantes dans la base).

## 9) Reprise recommandée (checklist rapide)

1. Re-lister les cartes ROC AX non-Feat restantes non câblées.
2. Implémenter uniquement les effets manquants (minimal, sans refacto large).
3. Vérifier diagnostics ciblés.
4. En fin de lot: revue rapide des triggers passifs (`EndTurn`) et des réductions de coût conditionnelles.

## 10) Prompt de reprise (copier/coller)

"Reprends l’implémentation AX ROC non-Feat dans `altered/modules/php/Cards/AX`. Utilise les patterns documentés dans `altered/HANDOFF_ROC_AX.md`, n’implémente pas les placeholders ni les Feats, et valide les erreurs PHP uniquement sur les fichiers touchés."

## 11) Delta important appris après coup (BR / ROC)

En complément d’AX, une grosse passe d’implémentation a été faite sur `modules/php/Cards/BR` (toujours en ignorant les Feats quand demandé), avec les points moteur suivants désormais présents:

- `modules/php/Helpers/Conditions.php`
  - `hasDiscardPileCards($n, $op='GTE')`
  - `hasControlFeat()`
- `modules/php/Models/Card.php`
  - `playLimitation = 'controlFeat'`
  - `playLimitation = 'discardPile6'`

## 12) État mouvant (très important en reprise)

Il y a eu des annulations utilisateur après implémentation (undo), donc le repo n’est pas un état linéaire.

Cartes BR explicitement revert à re-vérifier avant toute suite:

- `BR_Common_GuidingOcelot`
- `BR_Rare_GuidingOcelot`
- `BR_Rare_SpryScout`
- `BR_Rare_RekaFixer`
- `BR_Rare_Raksha`
- `BR_Rare_WildlifeMedic`
- `BR_Rare_InariSpiritofIndustry`
- `BR_Rare_MiaPrimaBallerina`

=> Règle de reprise: **toujours relire le contenu courant du fichier juste avant patch**, même s’il a déjà été traité dans une session précédente.

## 13) Correctifs BR confirmés récents

- `BR_Common_DevotedProtector` : ajout d’un câblage effectif (`effectReserve` conditionnel sur contrôle d’un feat).
- Erreurs de compilation `CORRUPTION` vues puis corrigées sur:
  - `BR_Exalted_PlagueofArrogance`
  - `BR_Rare_CorruptedToothFairy`

Note: ce type d’erreur peut réapparaître si de nouveaux stubs/fichiers sont introduits avec constantes non importées; en cas de doute, préférer la cohérence locale déjà adoptée dans le fichier concerné.

## 14) Prompt de reprise BR (copier/coller)

"Reprends la passe BR ROC non-Feat dans `altered/modules/php/Cards/BR` à partir de l’état actuel des fichiers (ne suppose pas l’historique). Avant chaque patch, relis le fichier ciblé; implémente seulement les `effect*` manquants ou annulés; puis lance des diagnostics PHP ciblés uniquement sur les fichiers touchés."
