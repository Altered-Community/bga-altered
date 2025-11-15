<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_LouisSullivan extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_86_R2',
            'asset'  => 'ALT_DUSTER_B_OR_86_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Louis Sullivan"),
      'typeline' => clienttranslate("Character - Engineer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Form ever follows function. This is the law." — Louis Sullivan'),
      'artist' => "Kevin Sidharta",
			'extension'=>'SDU',
   'subtypes'  => [ENGINEER],
 				'effectDesc' => clienttranslate('#{R}# If there are two or more cards in your Landmarks, draw a card.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
