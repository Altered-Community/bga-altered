<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_CorruptedToothFairy extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_108_R1',
            'asset'  => 'ALT_EOLE_B_YZ_108_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Corrupted Tooth Fairy"),
      'typeline' => clienttranslate("Character - Corruption Fairy"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Nestor Papatriantafyllou",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION,FAIRY],
 				'effectDesc' => clienttranslate('#I can\'t be played# unless six or more cards are in your discard pile.  {H} <SABOTAGE>.'),
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['forest','mountain','ocean'], 
];
  }
}
