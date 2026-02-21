<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Raksha extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_MU_110_R2',
      'asset'  => 'ALT_EOLE_B_MU_110_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Raksha"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Jefrey Yonathan",
      'extension' => 'ROC',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('{J} You may target another Character with {V} less than or equal to mine. It gains 1 boost.'),
      'forest' => 3,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest'],
    ];
  }
}
