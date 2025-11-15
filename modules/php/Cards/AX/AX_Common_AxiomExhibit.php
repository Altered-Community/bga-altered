<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_AxiomExhibit extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_101_C',
            'asset'  => 'ALT_DUSTER_B_AX_101_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Axiom Exhibit"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('"Let\'s show the Reka the brilliance of Axiom ingenuity!"'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SDU',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('{T} : Target Character in your Reserve gains 1 boost. Then exhaust it ({T}). (Exhausted cards can\'t be played and have no Support abilities.)'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
