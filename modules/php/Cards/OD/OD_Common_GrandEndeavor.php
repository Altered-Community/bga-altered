<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_GrandEndeavor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_29_C',
      'asset' => 'ALT_CORE_B_OR_29_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => 'Grand Endeavor',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => 'The Ordis built a relay of lighthouses to light the way through the Tumult.',
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [LANDMARK],
      'effectDesc' => 'At Noon — Target Expedition moves forward one region.',
      'costHand' => 6,
      'costReserve' => 6,
      'effectPassive' => [
        'Noon' => [
          'condition' => 'myTurn',
          'output' => FT::ACTION(MOVE_EXPEDITION, ['n' => 1, 'expedition' => null]),
        ]
      ]
    ];
  }
}
