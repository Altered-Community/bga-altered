<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_CorruptedToothFairy extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_108_C',
            'asset'  => 'ALT_EOLE_B_YZ_108_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Corrupted Tooth Fairy"),
      'typeline' => clienttranslate("Character - Corruption Fairy"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Nestor Papatriantafyllou",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION,FAIRY],
 				'effectDesc' => clienttranslate('{H} I gain <FLEETING> unless six or more cards are in your discard pile.  {H} <SABOTAGE>.'),
     'forest' => 1, 
     'mountain' => 2, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
