<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_SmokeThemOut extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_LY_121_R2',
      'asset'  => 'ALT_EOLE_B_LY_121_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Smoke Them Out"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('"Where there\'s smoke, there\'s fire… and we\'re proof of that!"'),
      'artist' => "Justice Wong",
      'extension' => 'ROC',
      'subtypes'  => [FEAT, LANDMARK],
      'effectDesc' => clienttranslate('{J} #Draw a card, then put a card from your hand in Reserve.#  When #three {T} abilities# are activated on one of your turns — Complete me.'),
      'supportDesc' => clienttranslate('<COMPLETED_LOW>: {T} : The next time a #{T} ability# is activated this turn, target Character #in play or in Reserve# gains 1 boost.'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::ACTION(DRAW, ['players' => ME]),
        FT::ACTION(TARGET, ['targetPlayer' => ME, 'targetLocation' => [HAND], 'targetType' => [CHARACTER, SPELL, PERMANENT], 'effect' => FT::DISCARD_TO_RESERVE()])
      ),
      // Arm the completed support: the next {T} ability this turn grants +1 boost.
      'effectTap' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'isThisFeatCompleted',
        'effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'useCard']),
      ]),
      'effectPassive' => [
        'Exhaust' => [
          'conditions' => ['smokeThemOutAxTrigger'],
          'output' => FT::ACTION(CHECK_CONDITION, [
            'condition' => 'isThisFeatIncomplete',
            'effect' => FT::ACTION(CHECK_CONDITION, [
              'condition' => 'checkAbilityActivatedThisTurnTypeCount:tap:3',
              'effect' => FT::ACTION(COMPLETE_FEAT, ['cardId' => 'source']),
            ]),
            'oppositeEffect' => FT::ACTION(CHECK_CONDITION, [
              'condition' => 'isUsed',
              'effect' => FT::SEQ(
                FT::ACTION(TARGET, [
                  'targetType' => [CHARACTER],
                  'targetLocation' => [RESERVE, STORM_LEFT, STORM_RIGHT],
                  'effect' => FT::GAIN(EFFECT, BOOST),
                ]),
                FT::ACTION(SPECIAL_EFFECT, ['effect' => 'unuseCard'])
              ),
            ]),
          ]),
        ],
      ],
    ];
  }
}
