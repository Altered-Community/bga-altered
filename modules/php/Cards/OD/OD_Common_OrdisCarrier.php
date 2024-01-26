<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_OrdisCarrier extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_30_C',
      'asset' => 'ALT_CORE_B_OR_30_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ordis Carrier'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('At Noon — Create an [ORDIS_RECRUIT] Soldier token in your Companion Expedition.'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'flavorText' => clienttranslate('The flow of Ordis Recruits seems to go on forever.'),
      'artist' => 'Taras Susak',

      'costHand' => 3,
      'costReserve' => 3,
      'effectPassive' => [
        'Noon' => [
          'condition' => 'myTurn',
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => $this->getPId(),
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => [STORM_RIGHT],
          ]),
        ],
      ],
    ];
  }
}
