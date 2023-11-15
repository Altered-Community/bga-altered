<?php
namespace ALT\Cards\AX;

class AX_Common_TheFoundryAxiomBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_29_C',
      'asset' => 'ALT_CORE_B_AX_29_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('The Foundry, Axiom Bastion'),
      'type' => PERMANENT,
      'subtype' => LANDMARK,
      'effectDesc' => clienttranslate(
        '{T} : The next time you play a Character from your hand this turn, trigger its {S} effects if it has any.  '
      ),
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}
