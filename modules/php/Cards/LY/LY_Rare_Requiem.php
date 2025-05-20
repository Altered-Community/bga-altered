<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_Requiem extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_MU_60_R2',
      'asset'  => 'ALT_BISE_B_MU_60_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Requiem"),
      'typeline' => clienttranslate("Spell - Disruption Song"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Preserving harmony. Maintaining balance. Sometimes one thing must die so that another may live.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'WFTM',
      'subtypes'  => [DISRUPTION, SONG],
      'effectDesc' => clienttranslate('#<COOLDOWN>.# (If I go to Reserve after my effect resolves, exhaust me {T}. Exhausted cards can\'t be played and have no Support abilities.)  Choose one:  • Discard target <FLEETING> #or <ASLEEP># Character with Hand Cost {4} or less.  • Discard target Permanent with Hand Cost {4} or less.'),
      'costHand' => 2,
      'costReserve' => 3,
      'changedStats' => ['costReserve'],
      'cooldown' => true,
      'effectPlayed' => FT::XOR(
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, TOKEN],
          'maxHandCost' => 4,
          'statuses' => [FLEETING, ASLEEP],
          'effect' => FT::ACTION(DISCARD, []),
        ]),
        FT::ACTION(TARGET, [
          'targetType' => [PERMANENT],
          'maxHandCost' => 4,
          'effect' => FT::ACTION(DISCARD, []),
        ])
      )
    ];
  }
}
