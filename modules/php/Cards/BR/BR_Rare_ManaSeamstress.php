<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_ManaSeamstress extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_109_R2',
            'asset'  => 'ALT_EOLE_B_YZ_109_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Mana Seamstress"),
      'typeline' => clienttranslate("Character - Artist Mage"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung",
			'extension'=>'ROC',
   'subtypes'  => [ARTIST,MAGE],
 				'effectDesc' => clienttranslate('#{H} If six or more cards are in your discard pile, discard target Character with Base Cost {1} or less.#'),
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 2, 
     'effectHand' => FT::ACTION(CHECK_CONDITION, [
      'condition' => 'hasDiscardPileCards:6',
      'effect' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER],
        'maxBaseCost' => 1,
        'effect' => FT::ACTION(DISCARD, []),
      ]),
    ]),
];
  }
}
