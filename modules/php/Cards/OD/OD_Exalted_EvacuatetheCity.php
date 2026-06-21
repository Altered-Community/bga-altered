<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Exalted_EvacuatetheCity extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_OR_122_E',
      'asset'  => 'ALT_EOLE_B_OR_122_E',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_EXALTED,
      'name'  => clienttranslate("Evacuate the City!"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('"The city is doomed. Prioritize the people!"'),
      'artist' => "Anh Tung & Ba Vo",
      'extension'=>'ROC',
      'subtypes'  => [FEAT,LANDMARK],
      'effectDesc' => clienttranslate('{J} Create an <ORDIS_RECRUIT> Soldier token in each of your <ASCENDED_S> Expeditions.  When one of your Expeditions moves forward <DUE_TO_ASCENSION> — Complete me.'),
      'supportDesc' => clienttranslate('<COMPLETED_LOW>: At Noon — Your Companion Expedition <ASCENDS>, then create an <ORDIS_RECRUIT> Soldier token in it.'),
      'costHand' => 2, 
      'costReserve' => 2, 
      'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'invokeRecruitOnAscendedExpeditions']),
      'effectPassive' => [
        'AfterDusk' => [
          'conditions' => ['isThisFeatIncomplete','isMe','movesAnyExpeditionDueToAscension'],
          'output' => FT::ACTION(COMPLETE_FEAT, ['cardId' => 'source']),
        ],
        'Noon' => [
          'conditions' => ['isMe', 'isThisFeatCompleted'],
          'output' => FT::SEQ(
            FT::ACTION(SPECIAL_EFFECT, ['effect' => 'ascend', 'expedition' => STORM_RIGHT]),
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => 'source',
              'tokenType' => 'OD_Common_OrdisRecruit',
              'targetLocation' => [STORM_RIGHT]
            ]),
          ),
        ],
      ]
    ];
  }
}
