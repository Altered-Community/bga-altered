<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_AxiomExhibit extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_101_R2',
            'asset'  => 'ALT_DUSTER_B_AX_101_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Axiom Exhibit"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('"Let\'s show the Reka the brilliance of Axiom ingenuity!"'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SDU',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('{T} : Target Character in your Reserve gains 1 boost. Then exhaust it ({T}).  #{T} : Target Character in your Reserve gains 1 boost. Then ready it.#'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
