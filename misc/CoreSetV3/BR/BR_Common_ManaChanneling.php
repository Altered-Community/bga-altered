<?php
namespace ALT\Cards\BR;

class BR_Common_ManaChanneling extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_27_C',
      'asset' => 'ALT_CORE_B_BR_27_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => 'Mana Channeling',
      'typeline' => 'Spell - Conjuration',
      'type' => SPELL,
      'flavorText' => "There's only one way to turn the tide: by becoming stronger.",
      'artist' => 'Zero Wen',
      'subtypes' => [CONJURATION],
      'effectDesc' => '$[FLEETING].  Put the top card of your deck in your Mana zone (as an exhausted Mana Orb).',
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
