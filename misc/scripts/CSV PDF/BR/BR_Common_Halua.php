<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_Halua extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_83_C',
            'asset'  => 'ALT_DUSTER_B_BR_83_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Halua"),
      'typeline' => clienttranslate("Token - Companion Leviathan"),
    	'type'  => TOKEN,
    	'flavorText'  => clienttranslate('Halua returns as the protector of the Naos.'),
      'artist' => "Fahmi Fauzi",
			'extension'=>'SDU',
   'subtypes'  => [COMPANION,LEVIATHAN],
 				'effectDesc' => clienttranslate('If your Hero has 5 or more Quest counters, I am <GIGANTIC>. (A Gigantic Character is considered present in both Expeditions.)'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
 		'gigantic' => true,
];
  }
}
