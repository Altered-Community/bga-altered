<?php
namespace ALT\Cards\BR;

class BR_Rare_ManaEruption extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_29_R1',
      'asset' => 'ALT_CORE_B_BR_29_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Mana Eruption'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]]. (Send me to Discard instead of Reserve after my effect resolves.)  Discard one of your Mana Orbs to discard target Character or Permanent.'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
