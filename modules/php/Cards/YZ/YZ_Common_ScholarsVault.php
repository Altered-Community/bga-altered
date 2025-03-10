<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_ScholarsVault extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_63_C',
            'asset'  => 'ALT_BISE_B_YZ_63_C',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Scholars' Vault"),
            'typeline' => clienttranslate("Landmark_permanent - Site"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Within its currents swim ancient knowledge and forgotten memories.'),
            'artist' => "Jean-Baptiste Andrier",
			'extension'=>'WFTM',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('{J} <RESUPPLY>.  If there are one or more Spells in your Reserve, your Reserve limit is increased by one.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
