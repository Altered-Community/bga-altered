<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_ZhenZephyr extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_65_C',
      'asset'  => 'ALT_CYCLONE_B_OR_65_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Zhen & Zephyr"),
      'typeline' => clienttranslate("Ordis Hero"),
      'type'  => HERO,
      'flavorText'  => clienttranslate('Those who stand without honor will fall without wings'),
      'artist' => "Zero Wen",
      'extension' => 'SO',
      'subtypes'  => [0],
      'effectDesc' => clienttranslate('At Noon — If you are first player, your Hero Expedition <ASCENDS>. (Until Rest, it can move forward even if matched in its region\'s terrains by the opponent\'s Expedition.)  When one or more of your Ascended Expeditions moves forward — If there is no Character facing it, draw a card.'),
      'reserveSlots' => 2,
      'landmarkSlots' => 2,
      'thumbnail' => 4,
      'statData' => 23,
      'effectPassive' => [
        'Noon' => [
          'listeningConditions' => ['isMe'],
          'condition' => 'isFirstPlayer',
          'output' => FT::SEQ(
            FT::ACTION(SPECIAL_EFFECT, ['effect' => 'ascend', 'expedition' => STORM_LEFT])
          )
        ],
        'AfterDusk' => [
          'listeningConditions' => ['movesAscendedAnyExpeditions', 'isMe'],
          'condition' => 'zhenZephyr',
          'output' => FT::ACTION(DRAW, ['players' => ME])
        ],
        'MoveExpedition' => [
          'conditions' => ['isMe', 'zhenZephyrMoveExpedition'],
          'output' => FT::ACTION(DRAW, ['players' => ME])
        ]
      ],
    ];
  }
}
