<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_KauriPuff extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_65_C',
      'asset'  => 'ALT_CYCLONE_B_MU_65_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Kauri & Puff"),
      'typeline' => clienttranslate("Muna Hero"),
      'type'  => HERO,
      'flavorText'  => clienttranslate('The language of nature has no use for words'),
      'artist' => "Ba Vo",
      'extension' => 'SO',
      'effectDesc' => clienttranslate('At Noon — If you are first player, create a <WOOLLYBACK> Animal token in target opponent\'s Companion Expedition, then draw a card.'),
      'reserveSlots' => 2,
      'landmarkSlots' => 2,
      'thumbnail' => 3,
      'statData' => 22,
      'effectPassive' => [
        'Noon' => [
          'listeningConditions' => ['isMe'],
          'condition' => 'isFirstPlayer',
          'output' => FT::SEQ(
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => 'source',
              'tokenType' => 'MU_Common_Woollyback',
              'targetLocation' => [STORM_RIGHT],
              'targetPlayer' => OPPONENT,
            ]),
            FT::ACTION(DRAW, ['players' => ME])
          )
        ],
      ],
    ];
  }
}
