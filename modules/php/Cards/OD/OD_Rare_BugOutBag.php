<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_BugOutBag extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_62_R2',
            'asset'  => 'ALT_BISE_B_AX_62_R',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Bug-Out Bag"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('They forgot to pack the Eat Me energy bars.'),
            'artist' => "Kevin Sidharta",
			'extension'=>'WFTM',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('{J} Create a <BRASSBUG> Robot token in my Expedition.  #{R} <RESUPPLY>.#'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
