<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_DrowsyDodo extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_72_R2',
      'asset'  => 'ALT_CYCLONE_B_MU_72_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Drowsy Dodo"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('After all that work, it\'s time for the dodo to go night-night.'),
      'artist' => "Huo Miao Studio",
      'extension' => 'SO',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('{J} I gain <ASLEEP>.  When a Character joins the Expedition facing me — #I gain 1 boost.#'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'mountain'],
      'effectPlayed' => FT::GAIN(ME, ASLEEP),
      'effectPassive' => [
        'ChooseAssignment' => [
          'listeningConditions' => ['isAddedCardAnyPlayer:character', 'isPlayedInOpponentExpedition'],
          'conditions' => ['isSourceSameLocation'],
          'output' =>  FT::GAIN(ME, BOOST)
        ],
        'InvokeToken' => [
          'listeningConditions' => ['isAddedCardAnyPlayer:character', 'isPlayedInOpponentExpedition'],
          'conditions' => ['isSourceSameLocation'],
          'output' =>  FT::GAIN(ME, BOOST)
        ],
        'MoveCard' => [
          'conditions' => ['isCardOfType:character', 'isPlayedInOpponentExpedition'],
          'output' =>  FT::GAIN(ME, BOOST)
        ],
        'EatMeEnergyBars' => [
          'conditions' => ['isPlayedInOpponentOtherExp'],
          'output' => FT::GAIN(ME, BOOST)
        ]
      ],
    ];
  }
}
