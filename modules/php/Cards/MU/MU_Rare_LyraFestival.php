<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;


class MU_Rare_LyraFestival extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_29_R2',
      'asset' => 'ALT_CORE_B_LY_29_R',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Lyra Festival',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' =>
      'When the time of the Kalann Mae comes, the Lyra all feel the call to a single place, where they will bring a masterpiece to life.',
      'artist' => 'Fahmi Fauzi',
      'subtypes' => [LANDMARK],
      'effectDesc' =>
      '{J} Draw a card.  At Dusk, if you control a <FLEETING> Character, another <ANCHORED> Character and yet another <ASLEEP> Character — You win the game.',
      'costHand' => 4,
      'costReserve' => 4,
      'effectPlayed' => FT::ACTION(DRAW, ['players' => ME]),
      'effectPassive' => [
        'BeforeDusk' => [
          'condition' => 'hasControlFleetingAnchoredAsleep',
          'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'instantWin']),
        ],
      ],
    ];
  }
}
