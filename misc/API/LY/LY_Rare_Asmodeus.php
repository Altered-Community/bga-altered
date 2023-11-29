<?php
namespace ALT\Cards\LY;

class LY_Rare_Asmodeus extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_20_R1',
      'asset' => 'ALT_CORE_B_LY_20_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Asmodeus'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate(
        '{J} Roll a die. On a 4 or more, I gain [[Anchored]]. Otherwise, I gain 3 boosts. (At Night, I don\'t go to Reserve and I lose Anchored.)'
      ),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
