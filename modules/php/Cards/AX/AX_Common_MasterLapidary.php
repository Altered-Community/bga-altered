<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_MasterLapidary extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_113_C',
            'asset'  => 'ALT_EOLE_B_AX_113_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Master Lapidary"),
      'typeline' => clienttranslate("Character - Engineer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   'subtypes'  => [ENGINEER],
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 4, 
     'costReserve' => 2, 
];
  }
}
