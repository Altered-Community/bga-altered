<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_OrdisCarrier extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_30_R',
      'asset' => 'ALT_CORE_B_OR_30_R',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Ordis Carrier',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => 'The flow of Ordis Recruits seems to go on forever.',
      'artist' => 'Taras Susak',
      'subtypes' => [LANDMARK],
      'effectDesc' => 'At Noon — Create an <ORDIS_RECRUIT> Soldier token in #each of your Expeditions#.',
      'costHand' => 5,
      'costReserve' => 5,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPassive' => [
        'Noon' => [
          'condition' => 'myTurn',
          'output' => FT::SEQ(
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => 'source',
              'tokenType' => 'OD_Common_OrdisRecruit',
              'targetLocation' => [STORM_LEFT],
            ]),
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => 'source',
              'tokenType' => 'OD_Common_OrdisRecruit',
              'targetLocation' => [STORM_RIGHT],
            ]),
          )
        ],
      ],
    ];
  }
}
