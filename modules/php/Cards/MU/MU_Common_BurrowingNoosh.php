<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_BurrowingNoosh extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_B_MU_49_C',
      'asset'  => 'ALT_BISE_B_MU_49_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Burrowing Noosh"),
      'typeline' => clienttranslate("Character - Plant Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('It takes years for roots to punch their way through the hardest stone, but for them it only takes a few hours.'),
      'artist' => "Ba Vo",
      'extension' => 'WFTM',
      'subtypes'  => [PLANT, ANIMAL],
      'forest' => 2,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}
