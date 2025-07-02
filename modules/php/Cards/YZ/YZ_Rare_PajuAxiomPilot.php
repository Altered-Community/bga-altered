<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_PajuAxiomPilot extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_70_R2',
      'asset'  => 'ALT_CYCLONE_B_AX_70_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Paju, Axiom Pilot"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Look, Paju. Wandering unknown skies was our dream, and now we\'ve achieved it." - Treyst'),
      'artist' => "Victor Canton",
      'extension' => 'SO',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('#When a Robot or a token joins my Expedition — If I have no boosts, I gain 1 boost, then create an <AEROLITH> token in your Landmarks.#'),
      'supportDesc' => clienttranslate('{D} : Create an <AEROLITH> token in target player\'s Landmarks.'),
      'supportIcon' => 'discard',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['ocean'],
      'effectPassive' => [
        'ChooseAssignment' => [
          'childs' => [
            [
              'conditions' => ['isCardAdded:token', 'isPlayedInSameLocation', 'isStillSameLocation'],
              'output' => FT::SEQ(
                FT::GAIN($this, BOOST),
                FT::ACTION(INVOKE_TOKEN, ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]])
              )
            ],
            [
              'conditions' => ['isCardAdded:robot', 'isPlayedInSameLocation', 'isStillSameLocation', 'isNotToken'],
              'output' => FT::SEQ(
                FT::GAIN($this, BOOST),
                FT::ACTION(INVOKE_TOKEN, ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]])
              )
            ],
          ],
        ],

        'InvokeToken' => [
          'childs' => [
            [
              'conditions' => ['isCardAdded:token', 'isPlayedInSameLocation', 'isStillSameLocation'],
              'output' => FT::SEQ(
                FT::GAIN($this, BOOST),
                FT::ACTION(INVOKE_TOKEN, ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]])
              )
            ],
            [
              'conditions' => ['isCardAdded:robot', 'isPlayedInSameLocation', 'isStillSameLocation', 'isNotToken'],
              'output' => FT::SEQ(
                FT::GAIN($this, BOOST),
                FT::ACTION(INVOKE_TOKEN, ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]])
              )
            ],
          ],
        ],
        'MoveCard' => [
          'childs' => [
            [
              'conditions' => ['isCardOfType:token', 'isPlayedInSameLocation', 'isStillSameLocation', 'hasSameOwner'],
              'output' => FT::SEQ(
                FT::GAIN($this, BOOST),
                FT::ACTION(INVOKE_TOKEN, ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]])
              )
            ],
            [
              'conditions' => ['isCardOfType:robot', 'isPlayedInSameLocation', 'isStillSameLocation', 'hasSameOwner', 'isNotToken'],
              'output' => FT::SEQ(
                FT::GAIN($this, BOOST),
                FT::ACTION(INVOKE_TOKEN, ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]])
              )
            ],
          ],
        ],
      ],
      'effectSupport' =>  [
        'action' => INVOKE_TOKEN,
        'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK], 'allPlayers' => true],
      ],
    ];
  }
}
