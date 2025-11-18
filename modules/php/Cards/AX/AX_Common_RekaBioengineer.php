<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_RekaBioengineer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_92_C',
            'asset'  => 'ALT_DUSTER_B_AX_92_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Reka Bioengineer"),
      'typeline' => clienttranslate("Character - Engineer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('In the wild rush to find new uses for Manaseeds, it seems the sky\'s the limit…'),
      'artist' => "Victor Canton",
			'extension'=>'SDU',
   'subtypes'  => [ENGINEER],
 				'effectDesc' => clienttranslate('{J} You may exhaust ({T}) a card in your Reserve to create a <MANASEED> token in your Landmarks. (It\'s a Permanent with \"{T}, Sacrifice me: Ready a Mana Orb.\")'),
     'forest' => 3, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
