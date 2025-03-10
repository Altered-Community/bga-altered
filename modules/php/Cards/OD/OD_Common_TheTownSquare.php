<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_TheTownSquare extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_63_C',
            'asset'  => 'ALT_BISE_B_OR_63_C',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("The Town Square"),
            'typeline' => clienttranslate("Landmark_permanent - Site"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('In light of the Ordis\' well-known organizational advantages, the Factions entrusted them with outpost logistics.'),
            'artist' => "Jean-Baptiste Andrier",
			'extension'=>'WFTM',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('At Dusk — I gain 1 Morale counter per Character you control.  {T}, Spend 6 of my Morale counters: Characters in target Expedition gain 1 boost.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
