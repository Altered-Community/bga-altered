<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_NikolaTesla extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_89_C',
            'asset'  => 'ALT_DUSTER_B_AX_89_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Nikola Tesla"),
      'typeline' => clienttranslate("Character - Engineer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"With this new invention, we can generate a force field to protect the city!"'),
      'artist' => "Fahmi Fauzi",
			'extension'=>'SDU',
   'subtypes'  => [ENGINEER],
 				'effectDesc' => clienttranslate('{R} I gain 1 boost if you control an exhausted Permanent or if there\'s an exhausted card in your Reserve.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
