<?php
namespace ALT\Cards\MU;

class MU_Rare_ManaEruption extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_29_R2',
      'asset' => 'ALT_CORE_B_BR_29_R2',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Mana Eruption'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Discard a Mana Orb to discard target Character or Permanent. (Send me to Discard instead of Reserve after my effect resolves.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}
