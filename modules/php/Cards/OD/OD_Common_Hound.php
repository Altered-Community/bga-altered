<?php
namespace ALT\Cards\OD;

class OD_Common_Hound extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_33_C',
            'asset'  => 'ALT_ALIZE_B_OR_33_C',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Hound"),
            'typeline' => clienttranslate("Character - Animal"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Like a dog with a bone.'),
            'artist' => "Anh Tung",
			'extension'=>'TBF',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{J} If my Expedition is behind, I gain 1 boost.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
