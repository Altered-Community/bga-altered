<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_YzmirNurse extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_51_C',
            'asset'  => 'ALT_BISE_B_YZ_51_C',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Yzmir Nurse"),
            'typeline' => clienttranslate("Character - Mage"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('The Cloister\'s Nurses may be harsh, but they work wonders, according to those who survive.'),
            'artist' => "Dimas Iswara",
			'extension'=>'WFTM',
   'subtypes'  => [MAGE],
 				'effectDesc' => clienttranslate('{H} You may sacrifice a Character. If you do, I gain 2 boosts.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
