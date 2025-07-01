<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_MarieCurie extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_73_C',
            'asset'  => 'ALT_CYCLONE_B_AX_73_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Marie Curie"),
      'typeline' => clienttranslate("Character - Scientist"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"It is important to make a dream of life and of a dream reality."'),
      'artist' => "Taras Susak",
			'extension'=>'SO',
   'subtypes'  => [SCIENTIST],
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
