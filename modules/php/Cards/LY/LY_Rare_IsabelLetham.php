<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_IsabelLetham extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_90_R2',
            'asset'  => 'ALT_DUSTER_B_BR_90_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Isabel Letham"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('The lowest point of the wave is where she draws all her strength.'),
      'artist' => "HuoMiao Studio",
			'extension'=>'SDU',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('{R} #<RESUPPLY>, then# you may <RUSH>.'),
     'forest' => 2, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['forest','costReserve'], 
 		'rush' => 'todo',
];
  }
}
