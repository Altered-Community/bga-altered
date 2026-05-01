<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_RekaWelder extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_122_R1',
      'asset'  => 'ALT_EOLE_B_AX_122_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Reka Welder"),
      'typeline' => clienttranslate("Character - Engineer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung",
      'extension' => 'ROC',
      'subtypes'  => [ENGINEER],
      'effectDesc' => clienttranslate('You play Permanents for {1} less, down to a minimum of {1}.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['forest', 'ocean'],
      'reduceCostType' => [PERMANENT => ['minBaseCost' => 0, 'reduction' => 1]],
      // TODO: VTO check minimum
    ];
  }
}
