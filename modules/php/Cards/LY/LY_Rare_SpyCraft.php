<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_SpyCraft extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_22_R2',
      'asset' => 'ALT_CORE_B_YZ_22_R',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Spy Craft',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => 'This message will self-destruct in five seconds.',
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [DISRUPTION],
      'effectDesc' => '$<FLEETING>.  $<SABOTAGE>, then $<RESUPPLY_LOW>.',
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, []),
        ]),
        FT::ACTION(RESUPPLY, [])
      ),
    ];
  }
}
