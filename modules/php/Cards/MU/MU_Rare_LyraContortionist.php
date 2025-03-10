<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_LyraContortionist extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_51_R2',
            'asset'  => 'ALT_BISE_B_LY_51_R',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Lyra Contortionist"),
            'typeline' => clienttranslate("Character - Artist"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('The Lyra from the Tisdhera clan will bend over backwards for their community.'),
            'artist' => "Khoa Viet",
			'extension'=>'WFTM',
   'subtypes'  => [ARTIST],
 				'supportDesc' => clienttranslate('{I} I don\'t count towards your Reserve limit.'),
 			     'supportIcon' => 'infinity',
     'forest' => 3, 
     'mountain' => 2, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['forest','mountain'], 
];
  }
}
