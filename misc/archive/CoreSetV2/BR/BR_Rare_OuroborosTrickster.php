<?php
namespace ALT\Cards\BR;

class BR_Rare_OuroborosTrickster extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_06_R2',
      'asset' => 'ALT_CORE_B_LY_06_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ouroboros Trickster'),
      'typeline' => clienttranslate('Character - Citizen'),
      'type' => CHARACTER,
      'subtypes' => [CITIZEN],
      'effectDesc' => clienttranslate('{J} Roll a die. On a 4 or higher, I gain 2 boosts. Otherwise, I gain 1 boost$[BB].'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 1,
    ];
  }
}
