<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_ClothCocoon extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_24_R2',
      'asset' => 'ALT_CORE_B_LY_24_R',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Cloth Cocoon'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'flavorText' => clienttranslate('Nobody expects... the cloth dancer!'),
      'artist' => 'Zero Wen',
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '$<FLEETING>.  Choose one:  • Discard target <FLEETING_CHAR>, <ANCHORED> or <ASLEEP> Character.  • Discard target Permanent.'
      ),
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
