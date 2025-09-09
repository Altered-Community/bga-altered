<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_SolHalua extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_65_C',
      'asset'  => 'ALT_CYCLONE_B_BR_65_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Sol & Halua"),
      'typeline' => clienttranslate("Bravos Hero"),
      'type'  => HERO,
      'flavorText'  => clienttranslate('Hate is a spear pointed at one\'s own heart'),
      'artist' => "Tristan Bideau",
      'extension' => 'SO',
      'effectDesc' => clienttranslate('When you pass first (stop taking turns before other players) — I gain 1 Quest counter. Then, if I have 3 or more Quest counters, create a <HALUA> token in your Companion Expedition. (It\'s a Leviathan Companion token with \"If your Hero has 5 or more Quest counters, I am Gigantic.\")'),
      'reserveSlots' => 2,
      'landmarkSlots' => 2,
      'thumbnail' => 4,
      'statData' => 20,
      'effectPassive' => [
        'EndTurn' => [
          'conditions' => ['isFirstPassing', 'isMe'],
          'output' => FT::SEQ(
            FT::ACTION(SPECIAL_EFFECT, [
              'effect' => 'incCounter',
              'args' => ['counter' => 1, 'counterName' => clienttranslate('Quest counters')],
            ]),
            FT::ACTION(CHECK_CONDITION, [
              'condition' => 'hasCounterOnCard:3',
              'effect' =>
              FT::ACTION(INVOKE_TOKEN, [
                'pId' => 'source',
                'tokenType' => 'BR_Common_Halua',
                'targetLocation' => [STORM_RIGHT],
              ]),
            ])
          )
        ]
      ]
    ];
  }
}
