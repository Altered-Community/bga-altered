<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_MechanicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_22_R2',
      'asset' => 'ALT_CORE_B_AX_22_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Mechanical Training',
      'typeline' => 'Spell - Boon',
      'type' => SPELL,
      'flavorText' => 'To learn to create, first learn to fix.',
      'artist' => 'Damian Audino',
      'subtypes' => [BOON],
      'effectDesc' => 'Activate the {j} triggers of target #Character# you control.',
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costHand'],
      'effectPlayed' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER],
        'targetPlayer' => ME,
        'hasEffects' => ['Played'],
        'effect' => FT::ACTION(ACTIVATE_EFFECT, []),
      ]),
    ];
  }
}
