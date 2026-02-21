<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_MasterLapidary extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_113_R2',
            'asset'  => 'ALT_EOLE_B_AX_113_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Master Lapidary"),
      'typeline' => clienttranslate("Character - Engineer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   'subtypes'  => [ENGINEER],
 				'effectDesc' => clienttranslate('#{H} You may sacrifice a Permanent to ready a Mana Orb.#'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 2, 
     'changedStats' => ['costHand'], 
];
  }
}
