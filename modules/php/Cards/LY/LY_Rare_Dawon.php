<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_Dawon extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_111_R2',
            'asset'  => 'ALT_EOLE_B_MU_111_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Dawon"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Victor Canton",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} You may target another Character with {V} less than or equal to mine. It gains <ANCHORED>.'),
     'forest' => 3, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 2, 
     'changedStats' => ['forest','ocean'], 
];
  }
}
