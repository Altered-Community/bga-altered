<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_ThomasEdison extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_90_R2',
            'asset'  => 'ALT_DUSTER_B_AX_90_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Thomas Edison"),
      'typeline' => clienttranslate("Character - Engineer Rogue"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Thanks to MY new invention, the city is safe!"'),
      'artist' => "Victor Canton",
			'extension'=>'SDU',
   'subtypes'  => [ENGINEER,ROGUE],
 				'effectDesc' => clienttranslate('{J} You may discard #up to two# Characters from your Reserve. If you do, I activate #up to two# of their {r} abilities as if they were mine.'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 5, 
     'costReserve' => 4, 
     'changedStats' => ['forest','mountain','ocean','costReserve'], 
];
  }
}
