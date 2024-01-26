<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_OpentheGates extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_26_C',
      'asset' => 'ALT_CORE_B_OR_26_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => 'Open the Gates',
      'typeline' => 'Spell - Maneuver',
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'effectDesc' => 'Create two [ORDIS_RECRUIT] Soldier tokens in each of your Expeditions.',
      'artist' => 'Jean-Baptiste Andrier',
      'flavorText' =>
        'For the first time in centuries, the Solstice Gate has opened. For the first time in ages, humanity will discover what lies beyond the gates.',

      'costHand' => 5,
      'costReserve' => 6,
      'effectPlayed' => FT::SEQ(
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => $this->getPId(),
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => [STORM_LEFT],
        ]),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => $this->getPId(),
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => [STORM_LEFT],
        ]),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => $this->getPId(),
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => [STORM_RIGHT],
        ]),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => $this->getPId(),
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => [STORM_RIGHT],
        ])
      ),
    ];
  }
}
