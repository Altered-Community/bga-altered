<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;


class LY_Rare_ClothCocoon extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_24_R1',
      'asset' => 'ALT_CORE_B_LY_24_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Cloth Cocoon',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => 'Nobody expects... the cloth dancer!',
      'artist' => 'Zero Wen',
      'subtypes' => [DISRUPTION],
      'effectDesc' => '$<FLEETING>.  Discard target <FLEETING_CHAR>, <ANCHORED> or <ASLEEP> Character.',
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::XOR(
          FT::ACTION(TARGET, [
            'statuses' => [FLEETING, ANCHORED, ASLEEP],
            'targetType' => [CHARACTER, TOKEN],
            'effect' => FT::ACTION(DISCARD, []),
          ]),
          FT::ACTION(TARGET, [
            'targetType' => [PERMANENT],
            'effect' => FT::ACTION(DISCARD, []),
          ]),
        )
      ),
    ];
  }
}
