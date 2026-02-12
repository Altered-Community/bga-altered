<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_ColorfulCuckoo extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_70_R1',
      'asset'  => 'ALT_CYCLONE_B_MU_70_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Colorful Cuckoo"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Even the shyest become a bit less reserved when they hear its song.'),
      'artist' => "Seppyo",
      'extension' => 'SO',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('{J} I gain <ANCHORED>.  When a Character joins the Expedition facing me — I gain 1 boost.  #When I go to your Reserve from the Expedition zone, if I had 2 or more boosts — You may put a card from your Reserve in your Mana zone (as an exhausted Mana Orb).#'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::GAIN(ME, ANCHORED),
      'effectPassive' => [
        'ChooseAssignment' => [
          'listeningConditions' => ['isAddedCardAnyPlayer:character', 'isPlayedInOpponentExpedition'],
          'conditions' => ['isSourceSameLocation'],
          'output' => FT::GAIN(ME, BOOST)
        ],
        'InvokeToken' => [
          'listeningConditions' => ['isAddedCardAnyPlayer:character', 'isPlayedInOpponentExpedition'],
          'conditions' => ['isSourceSameLocation'],
          'output' => FT::GAIN(ME, BOOST)
        ],
        'MoveCard' => [
          'conditions' => ['isCardOfType:character', 'isPlayedInOpponentExpedition', 'isSourceSameLocation'],
          'output' => FT::GAIN(ME, BOOST)
        ],
        'EatMeEnergyBars' => [
          'conditions' => ['isPlayedInOpponentOtherExp'],
          'output' => FT::GAIN(ME, BOOST)
        ],
        'LeaveExpedition' => [
          'conditions' => ['isToReserve', 'hasBoost:2'],
          'output' => FT::ACTION(TARGET, [
            'targetLocation' => [RESERVE],
            'targetType' => [TOKEN, CHARACTER, PERMANENT, SPELL],
            'targetPlayer' => ME,
            'upTo' => true,
            'effect' => FT::ACTION(DISCARD, [
              'destination' => MANA,
              'tapped' => true,
              'force' => true,
            ])
          ])
        ],
      ],
    ];
  }
}
