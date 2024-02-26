<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;


class OD_Rare_JianAssemblyOverseer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_10_R2',
      'asset' => 'ALT_CORE_B_AX_10_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Jian, Assembly Overseer',
      'typeline' => 'Character - Engineer',
      'type' => CHARACTER,
      'flavorText' =>
      '"This material does not seem to be affected by gravity. By harnessing the properties of this Aerolith, we could create flying ships and cities, and fly close to the clouds..."',
      'artist' => 'Khoa Viet',
      'subtypes' => [ENGINEER],
      'supportDesc' => '#{D} : Activate the {j} triggers of target Permanent you control.# (Discard me from Reserve to do this.)',
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'supportIcon' => 'discard',
      'effectSupport' => FT::ACTION(TARGET, [
        'targetType' => [PERMANENT],
        'targetPlayer' => ME,
        'hasEffects' => ['Played'],
        'effect' => FT::ACTION(ACTIVATE_EFFECT, []),
      ]),
    ];
  }
}
