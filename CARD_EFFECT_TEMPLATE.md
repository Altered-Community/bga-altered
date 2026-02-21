# Template d’implémentation d’une carte

## Métadonnées

- Carte:
- Fichier:
- Scope: (non-Feat / Feat / placeholder?)
- Source de vérité: `effectDesc` (+ `supportDesc`)

## Texte à mapper

- `effectDesc`:
- `supportDesc`:

## Mapping décidé

- Effet joué (`effectPlayed`):
- Effet depuis main (`effectHand`):
- Effet depuis réserve (`effectReserve`):
- Effet passif (`effectPassive`):
- Effet support (`effectSupport`):
- Coûts dynamiques / limitations:

## Snippets usuels

- Mise en réserve depuis main:

```php
FT::ACTION(TARGET, [
  'targetType' => [CHARACTER, SPELL, PERMANENT],
  'targetPlayer' => ME,
  'targetLocation' => [HAND],
  'upTo' => true,
  'effect' => FT::DISCARD_TO_RESERVE(),
]);
```

- Sabotage:

```php
FT::SABOTAGE();
```

- Aerolith:

```php
[
  'action' => INVOKE_TOKEN,
  'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]],
];
```

## Validation

- [ ] Le mapping respecte `effectDesc`
- [ ] Aucune logique inventée hors wording
- [ ] Diagnostics PHP OK
- [ ] Tracker mis à jour
