<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_SonofNaos extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_MU_97_C',
            'asset'  => 'ALT_DUSTER_B_MU_97_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Son of Naos"),
      'typeline' => clienttranslate("Character - Plant"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Can such entities be found near all world trees?'),
      'artist' => "Zael",
			'extension'=>'SDU',
   'subtypes'  => [PLANT],
 				'effectDesc' => clienttranslate('$<GIGANTIC>.  {J} Target opponent draws a card.'),
     'forest' => 4, 
     'mountain' => 3, 
     'ocean' => 4, 
     'costHand' => 5, 
     'costReserve' => 5, 
 		'gigantic' => true,
];
  }
}
