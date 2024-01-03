<?php
namespace ALT\Cards\BR;

class BR_Rare_Shenlong extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_22_R1',
      'asset' => 'ALT_CORE_B_BR_22_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Shenlong'),
      'typeline' => clienttranslate('Character - Dragon Deity'),
      'type' => CHARACTER,
      'subtypes' => [DRAGON, DEITY],
      'effectDesc' => clienttranslate('[Tough 1]. (Your opponent\'s Spells and abilities that target me cost {1} more.)'),
      'forest' => 9,
      'mountain' => 9,
      'ocean' => 9,
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}
