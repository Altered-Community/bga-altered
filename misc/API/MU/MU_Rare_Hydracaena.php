<?php
namespace ALT\Cards\MU;

class MU_Rare_Hydracaena extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_22_R1',
      'asset' => 'ALT_CORE_B_MU_22_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Hydracaena'),
      'typeline' => clienttranslate('Character - Plant Dragon'),
      'type' => CHARACTER,
      'subtypes' => [PLANT, DRAGON],
      'effectDesc' => clienttranslate(
        '{J} I gain 4 boosts.  [Tough X], where X is the number of plants you control. (Your opponent\'s Spells and abilities that target me cost {X} more.)  [Eternal]. (During Rest, I don\'t go to Reserve.)  At Noon — I gain 4 boosts.'
      ),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 7,
      'costReserve' => 7,
    ];
  }
}
