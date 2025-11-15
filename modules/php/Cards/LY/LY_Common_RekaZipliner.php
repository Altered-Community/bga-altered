<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_RekaZipliner extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_88_C',
            'asset'  => 'ALT_DUSTER_B_LY_88_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Reka Zipliner"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('The shortest distance between two points is a straight line.'),
      'artist' => "Victor Canton",
			'extension'=>'SDU',
   'subtypes'  => [ADVENTURER],
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
