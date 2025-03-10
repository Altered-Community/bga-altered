<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_ShortageSupervisor extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_55_C',
            'asset'  => 'ALT_BISE_B_AX_55_C',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Shortage Supervisor"),
            'typeline' => clienttranslate("Character - Engineer"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('With the appropriate tech, Sap can exhibit energetic properties sufficient to replace Kelon.'),
            'artist' => "Anh Tung",
			'extension'=>'WFTM',
   'subtypes'  => [ENGINEER],
 				'effectDesc' => clienttranslate('{R} If your hand is empty, I gain 1 boost.'),
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
