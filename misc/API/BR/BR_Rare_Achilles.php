<?php
namespace ALT\Cards\BR;

class BR_Rare_Achilles extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_21_R1',
      'asset' => 'ALT_CORE_B_BR_21_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Achilles'),
      'typeline' => clienttranslate('Character - Soldier'),
      'type' => CHARACTER,
      'subtypes' => [SOLDIER],
      'effectDesc' => clienttranslate('[Tough 2]. (Your opponent\'s Spells and abilities that target me cost {2} more.)'),
      'forest' => 5,
      'mountain' => 6,
      'ocean' => 6,
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
