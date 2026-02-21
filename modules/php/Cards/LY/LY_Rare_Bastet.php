<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_Bastet extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_111_R1',
            'asset'  => 'ALT_EOLE_B_LY_111_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Bastet"),
      'typeline' => clienttranslate("Character - Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jamin Amaral Fernandez",
			'extension'=>'ROC',
   'subtypes'  => [DEITY],
 				'supportDesc' => clienttranslate('{D} : The next Character with Base Cost {3} or less you play this turn gains <ANCHORED>.'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['mountain','ocean'], 
];
  }
}
