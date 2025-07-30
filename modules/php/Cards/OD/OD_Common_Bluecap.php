<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_Bluecap extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_69_C',
            'asset'  => 'ALT_CYCLONE_B_OR_69_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Bluecap"),
      'typeline' => clienttranslate("Character - Bureaucrat"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('To avoid sudden jolts, invest in stone.'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SO',
   'subtypes'  => [BUREAUCRAT],
 				'effectDesc' => clienttranslate('When my Expedition fails to move forward during Dusk — Create an <AEROLITH> token in your Landmarks. (It\'s a Permanent with \"When I\'m sacrificed — Resupply. {T}, {1}: Sacrifice me.\")'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
