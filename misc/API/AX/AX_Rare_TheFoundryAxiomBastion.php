<?php
namespace ALT\Cards\AX;

class AX_Rare_TheFoundryAxiomBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_29_R1',
      'asset' => 'ALT_CORE_B_AX_29_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('The Foundry, Axiom Bastion'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '{J} Draw a card.  {T} : Activate the {S} triggers of the next Character you play from your hand this turn.'
      ),
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}
