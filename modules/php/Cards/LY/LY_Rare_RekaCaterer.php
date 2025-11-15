<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_RekaCaterer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_94_R2',
            'asset'  => 'ALT_DUSTER_B_OR_94_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Reka Caterer"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Happiness is always within reach, if you know how to savor it. Care for a smoothie?"'),
      'artist' => "Damian Audino",
			'extension'=>'SDU',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('{J} Create a <MANASEED> token in your Landmarks.'),
 				'supportDesc' => clienttranslate('#{D} : Create a <ORDIS_RECRUIT> Soldier token in target Expedition.#'),
 			     'supportIcon' => 'discard',
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 4, 
     'changedStats' => ['forest','mountain'], 
];
  }
}
