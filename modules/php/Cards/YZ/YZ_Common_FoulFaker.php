<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_FoulFaker extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_89_C',
      'asset'  => 'ALT_DUSTER_B_YZ_89_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Foul Faker"),
      'typeline' => clienttranslate("Character - Rogue"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('What foul?!'),
      'artist' => "Justice Wong",
      'extension' => 'SDU',
      'subtypes'  => [ROGUE],
      'effectDesc' => clienttranslate('{H} If I\'m <IN_CONTACT>, <SABOTAGE_LOW>. (Discard up to one card from a Reserve. I\'m In Contact if another player\'s Expedition is in my region.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 1,
      'effectHand' => FT::ACTION(CHECK_CONDITION, ['condition' => 'isInContact', 'effect' => FT::SABOTAGE()])
    ];
  }
}
