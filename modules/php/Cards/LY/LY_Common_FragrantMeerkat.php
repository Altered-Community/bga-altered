<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_FragrantMeerkat extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_108_C',
            'asset'  => 'ALT_EOLE_B_LY_108_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Fragrant Meerkat"),
      'typeline' => clienttranslate("Character - Animal Artist"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zaeliven",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL,ARTIST],
     'forest' => 3, 
     'mountain' => 1, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 3, 
];
  }
}
