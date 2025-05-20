<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_Arawn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_MU_57_R2',
      'asset'  => 'ALT_BISE_B_MU_57_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Arawn"),
      'typeline' => clienttranslate("Character - Spirit"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The Wild Hunt comes to free the restless spirits.'),
      'artist' => "Taras Susak",
      'extension' => 'WFTM',
      'subtypes'  => [SPIRIT],
      'effectDesc' => clienttranslate('$<SCOUT_2> {2}.  {J} #Artists# you control gain 1 boost.'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 0,
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['ocean', 'costHand', 'costReserve'],
      'scout' => 2,
      'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostAllSubtype', 'args' => ['subType' => ARTIST]]),

    ];
  }
}
