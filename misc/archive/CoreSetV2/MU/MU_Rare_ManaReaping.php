<?php
namespace ALT\Cards\MU;

class MU_Rare_ManaReaping extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_26_R1',
      'asset' => 'ALT_CORE_B_MU_26_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Mana Reaping'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate('Put target Character or Permanent in its owner\'s Mana zone (as an exhausted Mana Orb).'),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
