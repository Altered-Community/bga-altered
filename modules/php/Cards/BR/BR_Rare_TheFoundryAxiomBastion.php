<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_TheFoundryAxiomBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_29_R2',
      'asset' => 'ALT_CORE_B_AX_29_R',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('The Foundry, Axiom Bastion'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'flavorText' => clienttranslate(
        'Embedded in the cliff wall, it overlooks the city and reminds everyone who looks up at it that nothing is unreachable if you put your mind to it.'
      ),
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('{T} : Activate the {r} triggers of the next Character you play from your hand this turn.'),
      'costHand' => 3,
      'costReserve' => 3,
      'effectTap' => FT::ACTION(SPECIAL_EFFECT, [
        'effect' => 'triggerEffectOfNextCharacter',
        'args' => ['type' => CHARACTER, 'from' => HAND, 'effect' => RESERVE],
      ]),
    ];
  }
}
