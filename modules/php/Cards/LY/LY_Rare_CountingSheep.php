<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_CountingSheep extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_80_R2',
      'asset'  => 'ALT_CYCLONE_B_MU_80_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Counting Sheep"),
      'typeline' => clienttranslate("Spell - Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('The deepest sleep is woven from the wool of sweet dreams.'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SO',
      'subtypes'  => [MANEUVER],
      'effectDesc' => clienttranslate('<FLEETING>.  Target two Expeditions and create a <WOOLLYBACK> Animal token in each one. Then, each Character with Hand Cost {1} or less gains <ASLEEP>.'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET_EXPEDITION, [
          'n' => 2,
          'effect' =>  FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'MU_Common_Woollyback',
          ]),
        ]),
        FT::ACTION(TARGET, [
          'maxHandCost' => 1,
          'n' => INFTY,
          'effect' => FT::GAIN(EFFECT, ASLEEP)
        ])
      )
    ];
  }
}
