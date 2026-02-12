<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_NightclubBouncer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_LY_94_C',
      'asset'  => 'ALT_DUSTER_B_LY_94_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Nightclub Bouncer"),
      'typeline' => clienttranslate("Character - Citizen"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"What part of \'dress code\' do you not understand?"'),
      'artist' => "Gamon Studio",
      'extension' => 'SDU',
      'subtypes'  => [CITIZEN],
      'effectDesc' => clienttranslate('{H} If I\'m <IN_CONTACT>, <SABOTAGE_LOW>. (I\'m In Contact if another player\'s Expedition is in my region.)'),
      'forest' => 4,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
      'effectHand' => FT::ACTION(CHECK_CONDITION, ['condition' => 'isInContact', 'effect' => FT::SABOTAGE()])
    ];
  }
}
