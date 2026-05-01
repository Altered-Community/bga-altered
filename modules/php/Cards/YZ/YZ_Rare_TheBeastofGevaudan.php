<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_TheBeastofGevaudan extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_114_R2',
            'asset'  => 'ALT_EOLE_B_MU_114_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("The Beast of Gévaudan"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Victor Canton",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} You may target another Character with {V} less than or equal to mine. It switches Expeditions.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['ocean','costHand'], 
];
  }
}
