<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_SonofNaos extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_97_R1',
      'asset'  => 'ALT_DUSTER_B_MU_97_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Son of Naos"),
      'typeline' => clienttranslate("Character - Plant"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Can such entities be found near all world trees?'),
      'artist' => "Zael",
      'extension' => 'SDU',
      'subtypes'  => [PLANT],
      'effectDesc' => clienttranslate('<GIGANTIC>.  {J} #You may# target an opponent, they draw a card.  #When you make a <GIFT> — I gain 1 boost.#'),
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
          'conditions' => ['isMyTurn', 'isAfternoon', 'isNotMeInvoke'],
          'output' => FT::GAIN(ME, BOOST, 1)
        ],
        'Draw' => [
          'conditions' => ['isMyTurn', 'isAfternoon', 'isNotMe'],
          'output' => FT::GAIN(ME, BOOST, 1)
        ],
        'Resupply' => [
          'conditions' => ['isMyTurn', 'isAfternoon', 'isNotMe'],
          'output' => FT::GAIN(ME, BOOST, 1)
        ]
      ]
    ];
  }
}
