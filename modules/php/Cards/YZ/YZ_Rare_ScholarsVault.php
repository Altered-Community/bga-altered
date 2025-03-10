<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_ScholarsVault extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_63_R1',
            'asset'  => 'ALT_BISE_B_YZ_63_R',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Scholars' Vault"),
            'typeline' => clienttranslate("Landmark_permanent - Site"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Within its currents swim ancient knowledge and forgotten memories.'),
            'artist' => "Jean-Baptiste Andrier",
			'extension'=>'WFTM',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('#You may play Spells of Hand Cost {7} or more for {1} less.#  If there are one or more Spells in your Reserve, your Reserve limit is increased by one.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
