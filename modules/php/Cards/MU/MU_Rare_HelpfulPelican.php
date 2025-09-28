<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_HelpfulPelican extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_67_R1',
      'asset'  => 'ALT_CYCLONE_B_MU_67_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Helpful Pelican"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('It\'s not unusual to see these pelicans ferrying small local creatures from one island to the next.'),
      'artist' => "Zael",
      'extension' => 'SO',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('#When a Character joins the Expedition facing me — If I\'m facing only one Character, <RESUPPLY_LOW>.#'),
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costReserve'],
      'effectPassive' => [
        'ChooseAssignment' => [
          'listeningConditions' => ['isAddedCardAnyPlayer:character', 'isPlayedInOpponentExpedition'],
          'conditions' => ['isOpponentExpeditionFilled:character:1'],
          'output' => FT::ACTION(RESUPPLY, [])
        ],
        'InvokeToken' => [
          'listeningConditions' => ['isAddedCardAnyPlayer:character', 'isPlayedInOpponentExpedition'],
          'conditions' => ['isOpponentExpeditionFilled:character:1'],
          'output' => FT::ACTION(RESUPPLY, [])
        ],
        'MoveCard' => [
          'conditions' => ['isCardOfType:character', 'isPlayedInOpponentExpedition', 'isOpponentExpeditionFilled:character:1'],
          'output' => FT::ACTION(RESUPPLY, [])
        ],
      ],
    ];
  }
}
