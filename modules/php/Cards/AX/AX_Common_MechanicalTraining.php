<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_MechanicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_22_C',
      'asset' => 'ALT_CORE_B_AX_22_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Mechanical Training',
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => 'Activate the {j} triggers of target Permanent you control.',
      'costHand' => 1,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(TARGET, [
        'targetType' => [PERMANENT],
        'targetPlayer' => ME,
        'hasEffects' => ['Played'],
        'effect' => FT::ACTION(ACTIVATE_EFFECT, []),
      ]),
      'flavorText' => 'To learn to create, first learn to fix.',
      'typeline' => 'Spell - Boon',
      'artist' => 'Damian Audino',
    ];
  }
}
