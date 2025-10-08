<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_DrowsyDodo extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_72_C',
      'asset'  => 'ALT_CYCLONE_B_MU_72_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Drowsy Dodo"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('After all that work, it\'s time for the dodo to go night-night.'),
      'artist' => "Huo Miao Studio",
      'extension' => 'SO',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('{J} I gain <ASLEEP>. (During Dusk, ignore my statistics. During Rest, I don\'t go to Reserve and I lose Asleep.)  When a Character joins the Expedition facing me — You may have me lose <ASLEEP>.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::GAIN(ME, ASLEEP),
      'effectPassive' => [
        'ChooseAssignment' => [
          'listeningConditions' => ['isAddedCardAnyPlayer:character', 'isPlayedInOpponentExpedition'],
          'conditions' => ['isSourceSameLocation', 'isAsleep'],
          'output' =>  FT::ACTION(LOOSE, ['type' => ASLEEP, 'cardId' => ME], ['optional' => true]),
        ],
        'InvokeToken' => [
          'listeningConditions' => ['isAddedCardAnyPlayer:character', 'isPlayedInOpponentExpedition'],
          'conditions' => ['isSourceSameLocation', 'isAsleep'],
          'output' =>  FT::ACTION(LOOSE, ['type' => ASLEEP, 'cardId' => ME], ['optional' => true]),
        ],
        'MoveCard' => [
          'conditions' => ['isCardOfType:character', 'isPlayedInOpponentExpedition', 'isAsleep'],
          'output' =>  FT::ACTION(LOOSE, ['type' => ASLEEP, 'cardId' => ME], ['optional' => true]),
        ],
      ],
    ];
  }
}
