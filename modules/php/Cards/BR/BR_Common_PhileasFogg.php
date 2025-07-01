<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_PhileasFogg extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_BR_71_C',
            'asset'  => 'ALT_CYCLONE_B_BR_71_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Phileas Fogg"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"The chance which now seems lost may present itself at the last moment." - Jules Verne'),
      'artist' => "DOBA",
			'extension'=>'SO',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('{R} You may immediately pass. (You end your Afternoon and don\'t take any more turns this Day.)'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
