<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_SigismarWingspan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_01_C',
      'asset' => 'ALT_CORE_B_OR_01_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Sigismar & Wingspan'),
      'type' => HERO,
      'thumbnail' => 0,
      'statData' => 14,
      'typeline' => clienttranslate('Ordis Hero'),

      'reserveSlots' => 2,
      'landmarkSlots' => 2,

      'effectDesc' => clienttranslate('At Noon — Create an <ORDIS_RECRUIT> Soldier token in your Hero Expedition.'),
      'flavorText' => clienttranslate('Follow me, friends! If we stand together, nothing can stop us! '),
      'artist' => 'Edward Cheekokseang',

      'effectPassive' => [
        'Noon' => [
          'condition' => 'isMe',
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => [STORM_LEFT],
          ]),
        ],
      ],
    ];
  }
}
