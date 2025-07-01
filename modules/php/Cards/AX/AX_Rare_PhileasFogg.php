<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_PhileasFogg extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_BR_71_R2',
            'asset'  => 'ALT_CYCLONE_B_BR_71_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Phileas Fogg"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"The chance which now seems lost may present itself at the last moment." - Jules Verne'),
      'artist' => "DOBA",
			'extension'=>'SO',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('{R} You may immediately pass. #If you do, I gain 1 boost.#'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
