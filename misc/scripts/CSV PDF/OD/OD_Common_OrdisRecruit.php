<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_OrdisRecruit extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_31_C',
            'asset'  => 'ALT_DUSTER_B_OR_31_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Ordis Recruit"),
      'typeline' => clienttranslate("Token - Soldier"),
    	'type'  => TOKEN,
    	'flavorText'  => clienttranslate('There\'s no age limit on adventure.'),
      'artist' => "Nestor Papatriantafyllou",
			'extension'=>'SDU',
   'subtypes'  => [SOLDIER],
 				'effectDesc' => clienttranslate('(If I leave the Expedition zone, remove me from the game.)'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
];
  }
}
