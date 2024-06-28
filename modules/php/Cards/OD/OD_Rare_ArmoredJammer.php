<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;


class OD_Rare_ArmoredJammer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'asset' => 'ALT_CORE_B_AX_28_R',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Armored Jammer',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => '"In a jam? Sorry, mate. Maybe a side-effect of our scrambling..."',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [LANDMARK],
      'effectDesc' => '{J} $<SABOTAGE>.  #When I leave your Landmark zone — <SABOTAGE>.#',
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, PERMANENT],
        'targetLocation' => [RESERVE],
        'upTo' => true,
        'effect' => FT::ACTION(DISCARD, []),
      ]),


      'effectPassive' => [
        'LeaveLandmark' => [
          'output' => FT::ACTION(TARGET, [
            'targetType' => [CHARACTER, SPELL, PERMANENT],
            'targetLocation' => [RESERVE],
            'upTo' => true,
            'effect' => FT::ACTION(DISCARD, []),
          ]),
        ],
      ]
    ];
  }
}
