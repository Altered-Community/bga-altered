<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_GrandEndeavor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_29_R2',
      'asset' => 'ALT_CORE_B_OR_29_R',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Grand Endeavor'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'flavorText' => clienttranslate('The Ordis built a relay of lighthouses to light the way through the Tumult.'),
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('At Noon — Target Expedition moves forward one region.'),
      'costHand' => 6,
      'costReserve' => 6,
      'effectPassive' => [
        'Noon' => [
          'condition' => 'isMe',
          'output' => FT::ACTION(MOVE_EXPEDITION, ['n' => 1, 'expedition' => null]),
        ],
      ],
    ];
  }
}
