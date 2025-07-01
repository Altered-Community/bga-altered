<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_Tengu extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_BR_70_C',
            'asset'  => 'ALT_CYCLONE_B_BR_70_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Tengu"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Calling the Tengu means submitting to anger and vanity, no?" - Basira'),
      'artist' => "Ed Chee, S.Yong & Stephen",
			'extension'=>'SO',
   'subtypes'  => [ADVENTURER],
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
