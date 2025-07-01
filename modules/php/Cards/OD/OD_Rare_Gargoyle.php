<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_Gargoyle extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_71_R1',
            'asset'  => 'ALT_CYCLONE_B_OR_71_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Gargoyle"),
      'typeline' => clienttranslate("Character - Elemental"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('At the slightest sign of intrusion, these stone lookouts come to life and sound the alarm.'),
      'artist' => "Taras Susak",
			'extension'=>'SO',
   'subtypes'  => [ELEMENTAL],
 				'effectDesc' => clienttranslate('#{J}# Target Expedition <ASCENDS>.'),
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
