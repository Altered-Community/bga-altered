<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_Charge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_23_R2',
      'asset' => 'ALT_CORE_B_OR_23_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Charge!',
      'typeline' => 'Spell - Maneuver',
      'type' => SPELL,
      'flavorText' => 'Facing terrible odds and an unfathomably huge Leviathan, the Ordis legion charged nonetheless.',
      'artist' => 'Zero Wen',
      'subtypes' => [MANEUVER],
      'effectDesc' => 'Characters you control gain 1 boost.',
      'costHand' => 2,
      'costReserve' => 3,
      'changedStats' => ['costReserve'],
      'effectPlayed' =>
      FT::ACTION(
        TARGET,
        ['targetPlayer' => ME, 'n' => INFTY, 'effect' => FT::GAIN($this, BOOST)]
      ),
    ];
  }
}
