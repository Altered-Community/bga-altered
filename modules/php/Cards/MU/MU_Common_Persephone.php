<?php
namespace ALT\Cards\MU;

class MU_Common_Persephone extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_33_C',
            'asset'  => 'ALT_ALIZE_B_MU_33_C',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Persephone"),
            'typeline' => clienttranslate("Character - Deity"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('After every winter must come spring.'),
            'artist' => "Zero Wen",
			'extension'=>'TBF',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('My region is {V} in addition to its other types.'),
     'forest' => 3, 
     'mountain' => 0, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
