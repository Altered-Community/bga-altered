<?php
namespace ALT\Cards\BR;

class BR_Rare_Dracaena extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_15_R2',
      'asset' => 'ALT_CORE_B_MU_15_R2',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Dracaena'),
      'typeline' => clienttranslate('Character - Plant Dragon'),
      'type' => CHARACTER,
      'subtypes' => [PLANT, DRAGON],
      'effectDesc' => clienttranslate('{J} I gain $[ANCHORED].  At Noon — I gain 1 boost.'),
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
