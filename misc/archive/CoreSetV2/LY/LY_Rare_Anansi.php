<?php
namespace ALT\Cards\LY;

class LY_Rare_Anansi extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_13_R1',
      'asset' => 'ALT_CORE_B_LY_13_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Anansi'),
      'typeline' => clienttranslate('Character - Artist'),
      'type' => CHARACTER,
      'subtypes' => [ARTIST],
      'effectDesc' => clienttranslate('{J} I gain 1 boost$[BB] for each card #in each player\'s Reserve#.'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 2,
      'changedStats' => ['forest', 'mountain', 'ocean'],
    ];
  }
}
