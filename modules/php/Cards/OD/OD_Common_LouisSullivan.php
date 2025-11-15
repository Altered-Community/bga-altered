<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_LouisSullivan extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_86_C',
            'asset'  => 'ALT_DUSTER_B_OR_86_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Louis Sullivan"),
      'typeline' => clienttranslate("Character - Engineer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Form ever follows function. This is the law." — Louis Sullivan'),
      'artist' => "Kevin Sidharta",
			'extension'=>'SDU',
   'subtypes'  => [ENGINEER],
 				'effectDesc' => clienttranslate('{H} If there are two or more cards in your Landmarks, draw a card.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
