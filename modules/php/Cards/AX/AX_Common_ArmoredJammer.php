<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_ArmoredJammer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_28_C',
      'asset' => 'ALT_CORE_B_AX_28_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Armored Jammer',
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => '{J} $[SABOTAGE].',
      'flavorText' => "\"In a jam? Sorry, mate. Maybe a side-effect of our scrambling...\"",
      'typeline' => 'Permanent - Landmark',
      'artist' => 'HuoMiao Studio',

      'costHand' => 2,
      'costReserve' => 2,

      'effectPlayed' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, PERMANENT],
        'targetLocation' => [RESERVE],
        'upTo' => true,
        'effect' => FT::ACTION(DISCARD, []),
      ]),
    ];
  }
}
