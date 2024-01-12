<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_JianAssemblyOverseer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_10_R1',
      'asset' => 'ALT_CORE_B_AX_10_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Jian, Assembly Overseer'),
      'type' => CHARACTER,
      'subtypes' => [ENGINEER],
      'supportDesc' => clienttranslate(
        '#{D} : Activate the {J} effect of target Permanent you control.# (Discard me from your Reserve to activate this effect)'
      ),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'effectSupport' => FT::ACTION(TARGET, [
        'targetType' => [PERMANENT],
        'targetPlayer' => ME,
        'hasEffects' => ['Played'],
        'effect' => FT::ACTION(ACTIVATE_EFFECT, []),
      ]),
    ];
  }
}
