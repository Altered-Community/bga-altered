<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_CountingSheep extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_80_R1',
      'asset'  => 'ALT_CYCLONE_B_MU_80_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Counting Sheep"),
      'typeline' => clienttranslate("Spell - Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('The deepest sleep is woven from the wool of sweet dreams.'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SO',
      'subtypes'  => [MANEUVER],
      'effectDesc' => clienttranslate('<FLEETING>.  Create a <WOOLLYBACK> Animal token #in each Expedition.# Then, each Character with Hand Cost {1} or less gains <ASLEEP>.'),
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET_EXPEDITION, [
          'expedition' => 'all',
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
