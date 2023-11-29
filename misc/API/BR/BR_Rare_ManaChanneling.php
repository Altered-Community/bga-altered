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
      'name' => clienttranslate('Mana Channeling'),
      'typeline' => clienttranslate('Spell - Conjuration'),
      'type' => SPELL,
      'subtypes' => [CONJURATION],
      'effectDesc' => clienttranslate('Put the top two cards of your deck in your Mana zone (as exhausted Mana Orbs).'),
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}
