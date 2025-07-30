<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_MountainNymph extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_70_R2',
            'asset'  => 'ALT_CYCLONE_B_LY_70_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Mountain Nymph"),
      'typeline' => clienttranslate("Character - Fairy"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('From a mere pebble, she creates a sparkling jewel.'),
      'artist' => "Tristan Bideau",
			'extension'=>'SO',
   'subtypes'  => [FAIRY],
 				'effectDesc' => clienttranslate('#{J}# If I\'m facing an Expedition in {M}, create an <AEROLITH> token in #target player\'s# Landmarks.'),
     'forest' => 0, 
     'mountain' => 4, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
