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
      'name' => 'The Foundry, Axiom Bastion',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' =>
        'Embedded in the cliff wall, it overlooks the city and reminds everyone who looks up at it that nothing is unreachable if you put your mind to it.',
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [LANDMARK],
      'effectDesc' =>
        '#{J} Draw a card.#  {T} : Activate the {r} triggers of the next Character you play from your hand this turn.',
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['costHand', 'costReserve'],
    ];
  }
}
