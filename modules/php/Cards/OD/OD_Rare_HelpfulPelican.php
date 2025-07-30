<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_HelpfulPelican extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_MU_67_R2',
            'asset'  => 'ALT_CYCLONE_B_MU_67_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Helpful Pelican"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('It\'s not unusual to see these pelicans ferrying small local creatures from one island to the next.'),
      'artist' => "Zael",
			'extension'=>'SO',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('#When a Character joins the Expedition facing me — If my Expedition is Ascended, <RESUPPLY_LOW>.#'),
     'forest' => 2, 
     'mountain' => 1, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costReserve'], 
];
  }
}
