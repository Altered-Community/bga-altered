<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_APebbleinthePond extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_119_C',
            'asset'  => 'ALT_EOLE_B_AX_119_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("A Pebble in the Pond"),
      'typeline' => clienttranslate("Spell - Boon"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'ROC',
   'subtypes'  => [BOON],
 				'effectDesc' => clienttranslate('Create an <AEROLITH> token in your Landmarks. (It\'s a Permanent with \"When I\'m sacrificed — Resupply. {T}, {1}: Sacrifice me.\")'),
     'costHand' => 2, 
     'costReserve' => 1, 
     'effectPlayed' => [
      'action' => INVOKE_TOKEN,
      'automatic' => true,
      'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]],
    ],
];
  }
}
