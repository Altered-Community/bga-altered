<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_CovertheRetreat extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_OR_121_C',
      'asset'  => 'ALT_EOLE_B_OR_121_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Cover the Retreat"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Kevin Sidharta",
			'extension'=>'ROC',
      'subtypes'  => [FEAT,LANDMARK],
      'effectDesc' => clienttranslate('{J} Create an <ORDIS_RECRUIT> Soldier token in each of your Expeditions.  When you pass — If seven or more Characters are in your Expeditions, complete me.'),
      'supportDesc' => clienttranslate('<COMPLETED>: When you create a token Character — You may exhaust me ({T}) to give it 1 boost. '),
      'costHand' => 2, 
      'costReserve' => 2, 
      'effectPlayed' => FT::SEQ(
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => [STORM_RIGHT],
        ]),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
          'targetLocation' => [STORM_LEFT],
          'moreThan1' => true,
        ])
      ),
      'effectPassive' => [
        'EndTurn' => [
          'conditions' => ['isMe', 'hasControl:character:7', 'isThisFeatIncomplete'],
          'output' => FT::ACTION(COMPLETE_FEAT, ['cardId' => 'source']),
        ],
        'InvokeToken' => [
          'conditions' => ['isMe', 'isCardPlayed:character', 'isThisFeatCompleted', 'notTapped'],
          'output' => FT::SEQ_OPTIONAL(
            FT::ACTION(TAP, []),
            FT::GAIN(EFFECT, BOOST),
          )
        ],
      ],
    ];
  }
}
