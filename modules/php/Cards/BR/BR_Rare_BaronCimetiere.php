<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_BaronCimetiere extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_120_R2',
            'asset'  => 'ALT_EOLE_B_YZ_120_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Baron Cimetière"),
      'typeline' => clienttranslate("Character - Mage"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung",
			'extension'=>'ROC',
   'subtypes'  => [MAGE],
 				'effectDesc' => clienttranslate('#{J} If you control a <COMPLETED_LOW> Feat,# create a <MANA_MOTH> Illusion token in target Expedition. #Otherwise, I gain 1 boost.#'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['forest','mountain','ocean','costHand'], 
     'effectPlayed' => FT::ACTION(CHECK_CONDITION, [
      'condition' => 'hasControl:feat:1',
      'effect' => FT::ACTION(TARGET_EXPEDITION, [
        'players' => ME,
        'effect' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'YZ_Common_ManaMoth',
        ]),
      ]),
      'oppositeEffect' => FT::GAIN(ME, BOOST),
    ]),
];
  }
}
