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
        '[[Fleeting]].  Discard a Mana Orb to discard target Character or Permanent. (Send me to Discard instead of Reserve after my effect resolves.)'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}
