<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_OrdisCarrier extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_30_R2',
      'asset' => 'ALT_CORE_B_OR_30_R',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Ordis Carrier',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => 'The flow of Ordis Recruits seems to go on forever.',
      'artist' => 'Taras Susak',
      'subtypes' => [LANDMARK],
      'effectDesc' => 'At Noon — Create an <ORDIS_RECRUIT> Soldier token in your Companion Expedition.',
      'costHand' => 3,
      'costReserve' => 3,
      'effectPassive' => [
        'Noon' => [
          'condition' => 'myTurn',
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => [STORM_RIGHT],
          ]),
        ],
      ],
    ];
  }
}
