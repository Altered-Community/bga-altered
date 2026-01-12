<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_MigratoryCrane extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_71_C',
      'asset'  => 'ALT_CYCLONE_B_MU_71_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Migratory Crane"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('When the cranes start their migration, that\'s the signal that it\'s time to seek out new horizons.'),
      'artist' => "Zael",
      'extension' => 'SO',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('When a Character joins the Expedition facing me — You may have me switch Expeditions. (I leave my Expedition and join your other Expedition.)'),
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPassive' => [
        'ChooseAssignment' => [
          'listeningConditions' => ['isAddedCardAnyPlayer:character', 'isPlayedInOpponentExpedition'],
          'conditions' => ['isSourceSameLocation'],
          'output' =>  FT::ACTION(MOVE_CARD, ['cardId' => ME], ['optional' => true])
        ],
        'InvokeToken' => [
          'listeningConditions' => ['isAddedCardAnyPlayer:character', 'isPlayedInOpponentExpedition'],
          'conditions' => ['isSourceSameLocation'],
          'output' =>  FT::ACTION(MOVE_CARD, ['cardId' => ME], ['optional' => true])
        ],
        'MoveCard' => [
          'conditions' => ['isCardOfType:character', 'isPlayedInOpponentExpedition'],
          'output' =>  FT::ACTION(MOVE_CARD, ['cardId' => ME], ['optional' => true])
        ],
        'EatMeEnergyBars' => [
          'conditions' => ['isPlayedInOpponentOtherExp'],
          'output' => FT::ACTION(MOVE_CARD, ['cardId' => ME], ['optional' => true])
        ]
      ],
    ];
  }
}
