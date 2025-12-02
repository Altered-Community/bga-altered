<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_UrbexSpecialist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_LY_92_R1',
      'asset'  => 'ALT_DUSTER_B_LY_92_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Urbex Specialist"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Exploration is always fun with the right company!'),
      'artist' => "DOBA",
      'extension' => 'SDU',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('If I\'m <IN_CONTACT>, my {V}, {M} and {O} are equal to my highest statistic. (I\'m In Contact if another player\'s Expedition is in my region.)  #{J} If I\'m not <IN_CONTACT>, I gain 1 boost.#'),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 2,
      'changedStats' => ['ocean'],
      'dynamicIncreaseBiomeHighestSelf' => '1:isInContact',
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'isNotInContact', 'effect' => FT::GAIN(ME, BOOST)])
    ];
  }
}
