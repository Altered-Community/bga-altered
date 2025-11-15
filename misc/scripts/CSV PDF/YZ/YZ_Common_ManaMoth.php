<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_ManaMoth extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_YZ_47_C',
            'asset'  => 'ALT_DUSTER_B_YZ_47_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Mana Moth"),
      'typeline' => clienttranslate("Token - Illusion"),
    	'type'  => TOKEN,
    	'flavorText'  => clienttranslate('Moths are at the core of Yzmir strategy.'),
      'artist' => "Ba Vo",
			'extension'=>'SDU',
   'subtypes'  => [ILLUSION],
 				'effectDesc' => clienttranslate('(If I leave the Expedition zone, remove me from the game.)'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
];
  }
}
