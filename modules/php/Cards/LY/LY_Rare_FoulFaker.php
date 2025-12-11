<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_FoulFaker extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_89_R2',
      'asset'  => 'ALT_DUSTER_B_YZ_89_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Foul Faker"),
      'typeline' => clienttranslate("Character - Rogue"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('What foul?!'),
      'artist' => "Justice Wong",
      'extension' => 'SDU',
      'subtypes'  => [ROGUE],
      'effectDesc' => clienttranslate('#{J}# If I\'m <IN_CONTACT>, <SABOTAGE_LOW>. (I\'m In Contact if another player\'s Expedition is in my region.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costReserve'],
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'isInContact', 'effect' => FT::SABOTAGE()])
    ];
  }
}
