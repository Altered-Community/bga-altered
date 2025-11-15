<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_DepartedBrother extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_101_C',
            'asset'  => 'ALT_DUSTER_B_BR_101_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Departed Brother"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"In my memory, you\'re there every time I cross paths with a Leviathan." — Sol'),
      'artist' => "Zero Wen",
			'extension'=>'SDU',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('{R} You may pay {1} to draw a card.'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 1, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
