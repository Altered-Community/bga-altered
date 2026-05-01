<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_BaronCimetiere extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_120_C',
            'asset'  => 'ALT_EOLE_B_YZ_120_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Baron Cimetière"),
      'typeline' => clienttranslate("Character - Mage"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung",
			'extension'=>'ROC',
   'subtypes'  => [MAGE],
 				'effectDesc' => clienttranslate('{H} If six or more cards are in your discard pile, create a <MANA_MOTH> Illusion token in target Expedition.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
