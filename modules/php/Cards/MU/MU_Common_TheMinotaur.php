<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_TheMinotaur extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_MU_58_C',
      'asset'  => 'ALT_BISE_B_MU_58_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("The Minotaur"),
      'typeline' => clienttranslate("Character - Animal Druid"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('As strong as an old oak with roots branching out beneath the ground.'),
      'artist' => "Matteo Spirito",
      'extension' => 'WFTM',
      'subtypes'  => [ANIMAL, DRUID],
      'effectDesc' => clienttranslate('$<SCOUT_3> {3}.  {J} Target Character with Hand Cost {3} or less gains <ANCHORED>. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 6,
      'costReserve' => 6,
      'scout' => 3,
      'effectPlayed' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::GAIN($this, ANCHORED)]),
    ];
  }
}
