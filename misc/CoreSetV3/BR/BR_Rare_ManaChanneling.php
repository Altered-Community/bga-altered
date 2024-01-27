<?php
namespace ALT\Cards\BR;

class BR_Rare_ManaChanneling extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_27_R1',
      'asset' => 'ALT_CORE_B_BR_27_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Mana Channeling',
      'typeline' => 'Spell - Conjuration',
      'type' => SPELL,
      'flavorText' => 'There\'s only one way to turn the tide: by becoming stronger.',
      'artist' => 'Zero Wen',
      'subtypes' => [CONJURATION],
      'effectDesc' => 'Put the top #two# cards of your deck in your Mana zone (as exhausted Mana Orbs).',
      'costHand' => 5,
      'costReserve' => 5,
      'changedStats' => ['costHand', 'costReserve'],
    ];
  }
}
