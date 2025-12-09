<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_SonofNaos extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_97_R2',
      'asset'  => 'ALT_DUSTER_B_MU_97_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Son of Naos"),
      'typeline' => clienttranslate("Character - Plant"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Can such entities be found near all world trees?'),
      'artist' => "Zael",
      'extension' => 'SDU',
      'subtypes'  => [PLANT],
      'effectDesc' => clienttranslate('<GIGANTIC>.  {J} #You may# target an opponent, they draw a card.  #When you make a <GIFT> — I gain 1 boost.# (A Gift is when on your turn, an opponent draws a card, Resupplies or receives a token.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 5,
      'costReserve' => 5,
      'changedStats' => ['forest', 'ocean'],
      'gigantic' => true,
      'effectPlayed' => FT::ACTION(DRAW, ['players' => OPPONENT], ['optional' => true]),
      'effectPassive' => [
        'InvokeToken' => [
          'conditions' => ['isMyTurn', 'isNotFirstTurn', 'isAfternoon', 'isNotMeInvoke'],
          'output' => FT::GAIN(ME, BOOST, 1)
        ],
        'Draw' => [
          'conditions' => ['isMyTurn', 'isNotFirstTurn', 'isAfternoon', 'isNotMe'],
          'output' => FT::GAIN(ME, BOOST, 1)
        ],
        'Resupply' => [
          'conditions' => ['isMyTurn', 'isNotFirstTurn', 'isAfternoon', 'isNotMe'],
          'output' => FT::GAIN(ME, BOOST, 1)
        ]
      ]
    ];
  }
}
