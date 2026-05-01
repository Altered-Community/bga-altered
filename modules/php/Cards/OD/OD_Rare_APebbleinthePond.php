<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_APebbleinthePond extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_119_R2',
            'asset'  => 'ALT_EOLE_B_AX_119_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("A Pebble in the Pond"),
      'typeline' => clienttranslate("Spell - Boon"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'ROC',
   'subtypes'  => [BOON],
 				'effectDesc' => clienttranslate('#Play me for {1} less if there are no tokens in your Landmarks.#  Create an <AEROLITH> token in your Landmarks.'),
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costReserve'], 
];
  }
}
