<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_TheInfirmary extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_YZ_102_R1',
            'asset'  => 'ALT_DUSTER_B_YZ_102_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("The Infirmary"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('"I told you it was a bad idea to drink all that Sap Cola…"'),
      'artist' => "HuoMiao Studio",
			'extension'=>'SDU',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('#{J} <RESUPPLY>.#  {T}, Exhaust a card in your Reserve: <AFTER_YOU>.'),
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
