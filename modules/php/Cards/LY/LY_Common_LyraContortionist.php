<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_LyraContortionist extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_51_C',
            'asset'  => 'ALT_BISE_B_LY_51_C',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Lyra Contortionist"),
            'typeline' => clienttranslate("Character - Artist"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('The Lyra from the Tisdhera clan will bend over backwards for their community.'),
            'artist' => "Khoa Viet",
			'extension'=>'WFTM',
   'subtypes'  => [ARTIST],
 				'supportDesc' => clienttranslate('{I} I don\'t count towards your Reserve limit.'),
 			     'supportIcon' => 'infinity',
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
