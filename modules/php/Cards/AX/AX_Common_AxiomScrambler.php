<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_AxiomScrambler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_15_C',
      'asset' => 'ALT_CORE_B_AX_15_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Axiom Scrambler'),
      'type' => CHARACTER,
      'subtype' => [ENGINEER],
      'effectDesc' => clienttranslate('{M} $[SABOTAGE].'),
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 4,
      'costReserve' => 4,
      'effectHand' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, PERMANENT],
        'targetLocation' => [RESERVE],
        'upTo' => true,
        'effect' => FT::ACTION(DISCARD, []),
      ]),
    ];
  }
}
