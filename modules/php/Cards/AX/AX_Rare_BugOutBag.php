<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_BugOutBag extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_62_R1',
            'asset'  => 'ALT_BISE_B_AX_62_R',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Bug-Out Bag"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('They forgot to pack the Eat Me energy bars.'),
            'artist' => "Kevin Sidharta",
			'extension'=>'WFTM',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('#{H}# Create a <BRASSBUG> Robot token in my Expedition.  #{R} <RESUPPLY>.#'),
     'costHand' => 3, 
     'costReserve' => 2, 
     'changedStats' => ['costHand'], 
];
  }
}
