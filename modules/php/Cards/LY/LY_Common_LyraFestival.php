<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_LyraFestival extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_29_C',
      'asset' => 'ALT_CORE_B_LY_29_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Lyra Festival'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '{J} Draw a card.  At Dusk — if you control a <FLEETING> Character, another <ANCHORED> Character and yet another <ASLEEP> Character, you win the game.'
      ),
      'flavorText' => clienttranslate(
        'When the time of the Kalann Mae comes, the Lyra all feel the call to a single place, where they will bring a masterpiece to life.'
      ),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'artist' => 'Fahmi Fauzi',

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
