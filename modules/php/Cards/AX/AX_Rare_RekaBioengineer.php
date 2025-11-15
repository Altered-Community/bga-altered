<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_RekaBioengineer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_92_R1',
            'asset'  => 'ALT_DUSTER_B_AX_92_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Reka Bioengineer"),
      'typeline' => clienttranslate("Character - Engineer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('In the wild rush to find new uses for Manaseeds, it seems the sky\'s the limit…'),
      'artist' => "Victor Canton",
			'extension'=>'SDU',
   'subtypes'  => [ENGINEER],
 				'effectDesc' => clienttranslate('{J} You may exhaust ({T}) target card in #any player\'s# Reserve. If you do, create a <MANASEED> token in #that player\'s# Landmarks.'),
     'forest' => 3, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 3, 
     'changedStats' => ['costReserve'], 
];
  }
}
