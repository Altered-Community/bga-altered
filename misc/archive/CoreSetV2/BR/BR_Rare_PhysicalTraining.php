<?php
namespace ALT\Cards\BR;

class BR_Rare_PhysicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_26_R1',
      'asset' => 'ALT_CORE_B_BR_26_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Physical Training'),
      'typeline' => clienttranslate('Spell - Boon'),
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate('Target Character gains 3 boosts$[BB].  #Draw a card.#'),
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand'],
    ];
  }
}
