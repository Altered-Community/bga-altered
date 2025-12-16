<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Exalted_PloutosRekaHexarch extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_96_E',
      'asset'  => 'ALT_DUSTER_B_MU_96_E',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_EXALTED,
      'name'  => clienttranslate("Ploutos, Reka Hexarch"),
      'typeline' => clienttranslate("Character - Druid Noble"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"My worker bees will increase our harvests!"'),
      'artist' => "Kevin Sidharta",
      'extension' => 'SDU',
      'subtypes'  => [DRUID, NOBLE],
      'effectDesc' => clienttranslate('{J} Target player <EXHAUSTED_RESUPPLIES>.  When you make a <GIFT> — Target Character gains <ANCHORED>.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 7,
      'costReserve' => 7,
      'effectPlayed' => FT::ACTION(TARGET_PLAYER, ['opponentsOnly' => false, 'effect' => FT::ACTION(RESUPPLY, ['exhausted' => true])]),
      'effectPassive' => [
        'InvokeToken' => [
          'conditions' => ['isMyTurn', 'isAfternoon', 'isNotMeInvoke'],
          'output' => FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, ANCHORED)]),
        ],
        'Draw' => [
          'conditions' => ['isMyTurn', 'isAfternoon', 'isNotMe'],
          'output' => FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, ANCHORED)]),
        ],
        'Resupply' => [
          'conditions' => ['isMyTurn', 'isAfternoon', 'isNotMe'],
          'output' => FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, ANCHORED)]),
        ]
      ]
    ];
  }
}
