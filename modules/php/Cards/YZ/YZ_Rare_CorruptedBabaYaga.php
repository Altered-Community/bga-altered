<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_CorruptedBabaYaga extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_114_R1',
            'asset'  => 'ALT_EOLE_B_YZ_114_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Corrupted Baba Yaga"),
      'typeline' => clienttranslate("Character - Corruption Mage"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Taras Susak",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION,MAGE],
 				'effectDesc' => clienttranslate('#I can\'t be played# unless six or more cards are in your discard pile.  {H} Draw a card.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 2, 
     'changedStats' => ['forest','mountain','ocean'], 
];
  }
}
