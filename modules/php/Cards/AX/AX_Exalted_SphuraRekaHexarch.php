<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Exalted_SphuraRekaHexarch extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_95_E',
            'asset'  => 'ALT_DUSTER_B_AX_95_E',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_EXALTED,
    	'name'  => clienttranslate("Sphura, Reka Hexarch"),
      'typeline' => clienttranslate("Character - Noble Engineer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"The Juice is more than just energy; it\'s our lifeblood!"'),
      'artist' => "Anh Tung",
			'extension'=>'SDU',
   'subtypes'  => [NOBLE,ENGINEER],
 				'effectDesc' => clienttranslate('Play me for {1} less if you control an exhausted Permanent.  Play me for {1} less if there\'s an exhausted card in your Reserve.  {J} If there are four or more exhausted cards among Permanents you control and cards in your Reserve, ready up to two of them.'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 5, 
     'costReserve' => 5, 
];
  }
}
