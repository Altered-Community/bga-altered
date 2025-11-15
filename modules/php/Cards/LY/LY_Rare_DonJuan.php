<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_DonJuan extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_96_R1',
            'asset'  => 'ALT_DUSTER_B_LY_96_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Don Juan"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Constancy is for insensitive clods alone."'),
      'artist' => "Justice Wong",
			'extension'=>'SDU',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('If I would go to Reserve from the Expedition zone, I gain <FLEETING> and defect instead. (I join the Expedition facing me, changing controllers.)'),
     'forest' => 0, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 2, 
     'costReserve' => 3, 
     'changedStats' => ['mountain','ocean','costHand','costReserve'], 
];
  }
}
