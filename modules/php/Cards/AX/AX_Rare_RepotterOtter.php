<?php
namespace ALT\Cards\AX;

class AX_Rare_RepotterOtter extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_34_R2',
            'asset'  => 'ALT_ALIZE_B_MU_34_R2',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Repotter Otter"),
            'typeline' => clienttranslate("Character - Animal"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('"Ah yes. Our new - celebrity."'),
            'artist' => "Khoa Viet",
			'extension'=>'TBF',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{J} Each player may put a card from their Hand in Reserve.'),
     'forest' => 0, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
