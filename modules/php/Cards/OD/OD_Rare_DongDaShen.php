<?php
namespace ALT\Cards\OD;

class OD_Rare_DongDaShen extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_35_R1',
            'asset'  => 'ALT_ALIZE_B_OR_35_R',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Dong Da Shen"),
            'typeline' => clienttranslate("Character - Bureaucrat Deity"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Justice is best served cold.'),
            'artist' => "Edward Chee & Seok Yeong",
			'extension'=>'TBF',
   'subtypes'  => [BUREAUCRAT,DEITY],
 				'effectDesc' => clienttranslate('#At Noon — #You may exhaust ({T}) target card in Reserve. (Exhausted cards can\'t be played and have no Support abilities.)'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['mountain','ocean','costHand','costReserve'], 
];
  }
}
