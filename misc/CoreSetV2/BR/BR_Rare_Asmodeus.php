<?php
namespace ALT\Cards\BR;

class BR_Rare_Asmodeus extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_20_R2',
      'asset' => 'ALT_CORE_B_LY_20_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Asmodeus'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate('{J} Roll a die. On a 4 or higher, I gain $[ANCHORED]. Otherwise, I gain 3 boosts.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}
