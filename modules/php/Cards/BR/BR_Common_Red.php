<?php

namespace ALT\Cards\BR;

class BR_Common_Red extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_10_C',
      'asset' => 'ALT_CORE_B_BR_10_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => 'Red',
      'type' => CHARACTER,
      'subtypes' => [ADVENTURER],
      'effectDesc' => '$[SEASONED].',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'seasoned' => true,
      'typeline' => 'Character - Adventurer',
      'flavorText' => 'Grandma would be proud.',
      'artist' => 'Jean-Baptiste Andrier',
    ];
  }
}
