<?php

namespace ALT\Cards\AX;

class AX_Common_AmeliaEarhart extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_11_C',
      'asset' => 'ALT_CORE_B_AX_11_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Amelia Earhart'),
      'type' => CHARACTER,
      'subtypes' => [ADVENTURER],

      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 1,
      'flavorText' => clienttranslate("\"The most effective way to do it, is to do it.\""),
      'typeline' => clienttranslate('Character - Adventurer'),
      'artist' => 'Taras Susak',
    ];
  }
}
