<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_ManaReaping extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_26_R',
      'asset' => 'ALT_CORE_B_MU_26_R',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Mana Reaping',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => 'Everything is energy and that\'s all there is to it.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [DISRUPTION],
      'effectDesc' => 'Put target Character or Permanent in its owner\'s Mana zone (as an exhausted Mana Orb).',
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::ACTION(TARGET, [
        'targetType' => [PERMANENT, CHARACTER],
        'effect' => FT::ACTION(DISCARD, ['destination' => MANA, 'tapped' => true]),
      ])

    ];
  }
}
