<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_AbandonedDepot extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_79_C',
            'asset'  => 'ALT_CYCLONE_B_AX_79_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Abandoned Depot"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('"There\'s no doubt about it... These ruins are the work of people from the City of Scholars." - Abiram'),
      'artist' => "Taras Susak",
			'extension'=>'SO',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Draw a card.  When I\'m sacrificed — Draw a card. (Excess Landmarks are sacrificed at the end of the Day.)  {T}, {1} : Sacrifice me.'),
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
