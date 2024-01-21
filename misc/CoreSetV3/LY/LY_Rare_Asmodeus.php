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
      'flavorText' => clienttranslate('Wanna play a game?'),
      'artist' => 'Zero Wen',
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate('{J} Roll a die. On a 4 or higher, I gain $[ANCHORED]. Otherwise, I gain 3 boosts$[BB].'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 5,
      'costReserve' => 5,
      'changedStats' => ['forest', 'mountain', 'ocean', 'costHand', 'costReserve'],
    ];
  }
}
