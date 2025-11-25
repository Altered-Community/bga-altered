<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_FlyingSquirrel extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_86_R2',
      'asset'  => 'ALT_DUSTER_B_BR_86_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Flying Squirrel"),
      'typeline' => clienttranslate("Character - Animal Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The second big jump is where the fun really starts.'),
      'artist' => "Matteo Spirito",
      'extension' => 'SDU',
      'subtypes'  => [ANIMAL, ADVENTURER],
      'effectDesc' => clienttranslate('{R} #If I\'m <IN_CONTACT>, I gain 2 boosts,# otherwise I gain 1 boost. (I\'m In Contact if another player\'s Expedition is in my region.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 2,
      'effectReserve' => FT::ACTION(CHECK_CONDITION, ['condition' => 'isInContact', 'effect' => FT::GAIN(ME, BOOST, 2), 'oppositeEffect' => FT::GAIN(ME, BOOST)])
    ];
  }
}
