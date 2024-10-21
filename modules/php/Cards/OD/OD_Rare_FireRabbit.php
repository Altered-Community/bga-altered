<?php
namespace ALT\Cards\OD;

class OD_Rare_FireRabbit extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_32_R2',
            'asset'  => 'ALT_ALIZE_B_BR_32_R2',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Fire Rabbit"),
            'typeline' => clienttranslate("Character - Animal Spirit"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Hot bunny in your area wants to meet!'),
            'artist' => "Khoa Viet",
			'extension'=>'TBF',
   'subtypes'  => [ANIMAL,SPIRIT],
 				'effectDesc' => clienttranslate('{H} You may have me gain <FLEETING_CHAR>. If you do, another target Character gains 1 boost.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 0, 
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
