# Runbook – Implémentation de cartes (Altered)

## Objectif

Procédure standard pour implémenter rapidement une carte depuis `effectDesc` vers code exécutable (`effectHand`, `effectReserve`, `effectPassive`, etc.) sans réinventer la logique.

## 1) Workflow recommandé

1. Identifier la carte cible (`modules/php/Cards/<Faction>/<File>.php`).
2. Lire `effectDesc` + `supportDesc`.
3. Chercher un pattern équivalent déjà codé (même wording, même mécanique).
4. Implémenter le strict minimum dans les propriétés `effect*`.
5. Lancer diagnostics PHP sur les fichiers touchés.
6. Mettre à jour le tracker de progression.

## 2) Mapping rapide wording -> code

- "When you pass" -> `effectPassive['EndTurn']`.
- "You may put a card from your hand in Reserve" -> `TARGET` sur `HAND` + `FT::DISCARD_TO_RESERVE()`.
- "Sabotage" -> `FT::SABOTAGE()`.
- "Create an <AEROLITH> token in your Landmarks" -> `INVOKE_TOKEN` + `tokenType => 'NE_Common_Aerolith'` + `targetLocation => [LANDMARK]`.
- "Pay {1} less for next ... this Afternoon" -> `SPECIAL_EFFECT` `costReduction` (`permanent => true`).
- "Activate its {j} abilities" -> `FT::ACTION(ACTIVATE_EFFECT, [])` sur cible compatible.

## 3) Points moteur déjà disponibles

- Condition: `hasXCardsInHand` (`GTE|LTE|EQ`) dans `Helpers/Conditions.php`.
- Condition: `hasNoTokensInLandmarks` dans `Helpers/Conditions.php`.
- Limitation de jeu: `playLimitation = 'singleCardHand'` dans `Models/Card.php`.

## 4) Règles de scope

- Ignorer placeholders si demandé.
- Ignorer Feats si demandé.
- Ne pas traiter des erreurs historiques hors scope sans validation.
- Préférer des changements ciblés (pas de refacto transversal).

## 5) Validation minimale

- Diagnostics PHP uniquement sur les fichiers modifiés.
- Vérifier qu’aucune propriété `effect*` n’est incohérente avec `effectDesc`.
- Vérifier les triggers passifs (`EndTurn`, `Noon`, etc.) et les conditions.
