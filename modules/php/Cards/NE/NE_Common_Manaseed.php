<?php
namespace ALT\Cards\NE;
use ALT\Helpers\FT;

class NE_Common_Manaseed extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_NE_04_C',
            'asset'  => 'ALT_DUSTER_B_NE_04_C',

    	'faction'  => FACTION_NE,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Manaseed"),
      'typeline' => clienttranslate("Token_landmark_permanent - Sap"),
    	'type'  => TOKEN_LANDMARK_PERMANENT,
    	'flavorText'  => clienttranslate('The Reka draw all of their riches from its Juice.'),
      'artist' => "Taras Susak",
			'extension'=>'SDU',
   'subtypes'  => [SAP],
 				'effectDesc' => clienttranslate('{T}, Sacrifice me: Ready a Mana Orb.'),
];
  }
}
