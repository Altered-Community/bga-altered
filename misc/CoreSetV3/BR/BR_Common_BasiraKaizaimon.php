<?php
namespace ALT\Cards\BR;

class BR_Common_BasiraKaizaimon extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_03_C',
      'asset' => 'ALT_CORE_B_BR_03_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => 'Basira & Kaizaimon',
      'typeline' => 'Bravos Hero',
      'type' => HERO,
      'flavorText' => 'Only the worthy shall achieve true transcendence under my guidance.',
      'artist' => 'Nestor Papatriantafyllou',
      'effectDesc' =>
        'When a Character you control gains 1 or more boosts — You may exhaust me ({T}) to have target Character gain 1 boost$[BB].',
    ];
  }
}
