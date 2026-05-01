<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_Bastet extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_111_C',
            'asset'  => 'ALT_EOLE_B_LY_111_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Bastet"),
      'typeline' => clienttranslate("Character - Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jamin Amaral Fernandez",
			'extension'=>'ROC',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('(An Anchored Character doesn\'t go to Reserve during Rest and loses Anchored.)'),
 				'supportDesc' => clienttranslate('{D} : The next Character with Base Cost {3} or less you play this turn gains <ANCHORED>. (Discard me from Reserve to do this.)'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
