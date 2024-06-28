<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_OpentheGates extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_26_R2',
      'asset' => 'ALT_CORE_B_OR_26_R',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Open the Gates',
      'typeline' => 'Spell - Maneuver',
      'type' => SPELL,
      'flavorText' =>
      'For the first time in centuries, the Solstice Gate has opened. For the first time in ages, humanity will discover what lies beyond the gates.',
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [MANEUVER],
      'effectDesc' => 'Create #a <BRASSBUG> Robot# token in each of your Expeditions.',
      'costHand' => 4,
      'costReserve' => 5,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::SEQ(
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'AX_Common_Brassbug',
          'targetLocation' => [STORM_LEFT],
        ]),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'AX_Common_Brassbug',
          'targetLocation' => [STORM_RIGHT],
        ])
      ),
    ];
  }
}
