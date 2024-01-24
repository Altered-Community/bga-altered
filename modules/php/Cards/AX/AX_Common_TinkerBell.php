<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_TinkerBell extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_09_C',
      'asset' => 'ALT_CORE_B_AX_09_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Tinker Bell',
      'type' => CHARACTER,
      'subtypes' => [FAIRY],
      'effectDesc' => '{R} $[SABOTAGE].',
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,

      'effectReserve' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
        'targetLocation' => [RESERVE],
        'upTo' => true,
        'effect' => FT::ACTION(DISCARD, []),
      ]),
      'flavorText' => "Ting! Ting-a-ling! There's something magical in mischievous tinkering...",
      'typeline' => 'Character - Fairy',
      'artist' => 'Anh Tung',
    ];
  }
}
