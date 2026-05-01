<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_CorruptedBabaYaga extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_114_R2',
            'asset'  => 'ALT_EOLE_B_YZ_114_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Corrupted Baba Yaga"),
      'typeline' => clienttranslate("Character - Corruption Mage"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Taras Susak",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION,MAGE],
 				'effectDesc' => clienttranslate('{H} I gain <FLEETING> unless six or more cards are in your discard pile.  {H} Draw a card.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
