<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_ClothCocoon extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_24_C',
      'asset' => 'ALT_CORE_B_LY_24_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Cloth Cocoon'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '$<FLEETING>.  Choose one:  • Discard target <FLEETING_CHAR>, <ANCHORED> or <ASLEEP> Character.  • Discard target Permanent.'
      ),
      'typeline' => clienttranslate('Spell - Disruption'),
      'flavorText' => clienttranslate('Nobody expects... the cloth dancer!'),
      'artist' => 'Zero Wen',

      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::XOR(
          FT::ACTION(TARGET, [
            'statuses' => [FLEETING, ANCHORED, ASLEEP],
            'targetType' => [CHARACTER, TOKEN],
            'effect' => FT::ACTION(DISCARD, []),
          ]),
          FT::ACTION(TARGET, [
            'targetType' => [PERMANENT],
            'effect' => FT::ACTION(DISCARD, []),
          ])
        )
      ),
    ];
  }
}
