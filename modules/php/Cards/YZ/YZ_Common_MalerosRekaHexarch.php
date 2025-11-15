<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_MalerosRekaHexarch extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_YZ_94_C',
            'asset'  => 'ALT_DUSTER_B_YZ_94_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Maleros, Reka Hexarch"),
      'typeline' => clienttranslate("Character - Noble Rogue"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Congratulations. Forcing me to take the field is no small feat."'),
      'artist' => "Justice Wong",
			'extension'=>'SDU',
   'subtypes'  => [NOBLE,ROGUE],
 				'effectDesc' => clienttranslate('{H} Pay {7} less for the next Spell you play this Afternoon.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 4, 
     'costHand' => 7, 
     'costReserve' => 3, 
];
  }
}
