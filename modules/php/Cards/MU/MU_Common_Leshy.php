<?php
namespace ALT\Cards\MU;

class MU_Common_Leshy extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_38_C',
            'asset'  => 'ALT_ALIZE_B_MU_38_C',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Leshy"),
            'typeline' => clienttranslate("Character - Plant Deity"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('"I am strong, and you are in my woods!"'),
            'artist' => "Ba Vo",
			'extension'=>'TBF',
   'subtypes'  => [PLANT,DEITY],
 				'effectDesc' => clienttranslate('{J} I gain 1 boost for each Expedition in {V}.'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 5, 
     'costReserve' => 5, 
];
  }
}
