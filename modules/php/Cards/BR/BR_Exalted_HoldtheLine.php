<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Exalted_HoldtheLine extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_122_E',
      'asset'  => 'ALT_EOLE_B_BR_122_E',
      'faction'  => FACTION_BR,
      'rarity'  => RARITY_EXALTED,
      'name'  => clienttranslate("Hold the Line!"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('"Don\'t let them outflank us!"'),
      'artist' => "Anh Tung & Ba Vo",
      'extension' => 'ROC',
      'subtypes'  => [FEAT, LANDMARK],
      'effectDesc' => clienttranslate('{J} Target Character gains 2 boosts.  When you pass — If you control two or more <BOOSTED_CHA_P> Characters, complete me.'),
      'supportDesc' => clienttranslate('<COMPLETED_LOW>: When a Companion joins your Expeditions — It gains 1 boost.'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(TARGET, [
        'effect' => FT::GAIN(EFFECT, BOOST, 2),
      ]),
      'effectPassive' => [
        // Pass uses EndTurn listener in this rules engine.
        'EndTurn' => [
          'conditions' => ['isMe', 'hasControl::2:false:boosted', 'isThisFeatIncomplete'],
          'output' => FT::ACTION(COMPLETE_FEAT, ['cardId' => 'source']),
        ],
        // Completed support: companions joining your expeditions gain 1 boost.
        'ChooseAssignment' => [
          'conditions' => ['isThisFeatCompleted', 'isCardAddedAnyPlayer:companion', 'isStillSameLocation'],
          'output' => FT::GAIN(EFFECT, BOOST),
        ],
        'InvokeToken' => [
          'conditions' => ['isThisFeatCompleted', 'isCardAddedAnyPlayer:companion', 'isStillSameLocation'],
          'output' => FT::GAIN(EFFECT, BOOST),
        ],
        'MoveCard' => [
          'conditions' => ['isThisFeatCompleted', 'isCardAddedAnyPlayer:companion', 'hasSameOwner', 'isStillSameLocation'],
          'output' => FT::GAIN(EFFECT, BOOST),
        ],
      ],
    ];
  }
}
