<?php
namespace ALT\Cards\BR;

class BR_Common_ManaEruption extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_29_C',
      'asset' => 'ALT_CORE_B_BR_29_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Mana Eruption'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]]. (Send me to Discard instead of Reserve after my effect resolves.)  Discard one of your Mana Orbs to discard target Character or Permanent.'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
