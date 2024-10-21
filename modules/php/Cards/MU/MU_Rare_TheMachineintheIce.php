<?php
namespace ALT\Cards\MU;

class MU_Rare_TheMachineintheIce extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_32_R2',
            'asset'  => 'ALT_ALIZE_B_AX_32_R2',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("The Machine in the Ice"),
            'typeline' => clienttranslate("Character - Robot"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('A relic left by those who came before.'),
            'artist' => "Edward Chee & Seok Yeong",
			'extension'=>'TBF',
   'subtypes'  => [ROBOT],
 				'effectDesc' => clienttranslate('When I go to Reserve from anywhere — Exhaust me ({T}). (Exhausted cards can\'t be played and have no Support abilities.)  {H} Send me to Reserve.'),
     'forest' => 5, 
     'mountain' => 3, 
     'ocean' => 5, 
     'costHand' => 1, 
     'costReserve' => 3, 
];
  }
}
