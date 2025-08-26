<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_DrowsyDodo extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_72_R1',
      'asset'  => 'ALT_CYCLONE_B_MU_72_R',

      'faction'  => FACTION_MU,
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
          'listeningConditions' => ['isAddedCardOpponentEvent:character', 'isPlayedInOpponentExpedition'],
          'conditions' => ['isSourceSameLocation'],
          'output' =>  FT::ACTION(LOOSE, ['type' => ASLEEP, 'cardId' => ME], ['optional' => true]),
        ],
        'InvokeToken' => [
          'listeningConditions' => ['isAddedCardOpponentEvent:character', 'isPlayedInOpponentExpedition'],
          'conditions' => ['isSourceSameLocation'],
          'output' =>  FT::ACTION(LOOSE, ['type' => ASLEEP, 'cardId' => ME], ['optional' => true]),
        ],
        'MoveCard' => [
          'conditions' => ['isCardOfType:character', 'isPlayedInOpponentExpedition'],
          'output' =>  FT::ACTION(LOOSE, ['type' => ASLEEP, 'cardId' => ME], ['optional' => true]),
        ],
      ],
    ];
  }
}
