<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_CovertheRetreat extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_OR_121_R2',
      'asset'  => 'ALT_EOLE_B_OR_121_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Cover the Retreat"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('"Don\'t break ranks!"'),
      'artist' => "Kevin Sidharta",
			'extension'=>'ROC',
      'subtypes'  => [FEAT,LANDMARK],
      'effectDesc' => clienttranslate('{J} Create a #<MANA_MOTH> Illusion# token in each of your Expeditions.  #At Noon# — If #six or more cards are in your discard pile,# complete me.'),
      'supportDesc' => clienttranslate('<COMPLETED_LOW>: When you create a token Character — You may exhaust me ({T}) to give it 1 boost. '),
      'costHand' => 3, 
      'costReserve' => 3, 
      'changedStats' => ['costHand','costReserve'], 
      'effectPlayed' => FT::SEQ(
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => [STORM_RIGHT],
        ]),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
          'targetLocation' => [STORM_LEFT],
          'moreThan1' => true,
        ])
      ),
      'effectPassive' => [
        'Noon' => [
          'conditions' => ['isMe', 'hasDiscardPileCards:6:GTE', 'isThisFeatIncomplete'],
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
