<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_RekaMagnate extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_93_C',
            'asset'  => 'ALT_DUSTER_B_AX_93_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Reka Magnate"),
      'typeline' => clienttranslate("Character - Bureaucrat"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"A disruptive smoothie to knock the competition off balance!"'),
      'artist' => "Nestor Papatriantafyllou",
			'extension'=>'SDU',
   'subtypes'  => [BUREAUCRAT],
 				'effectDesc' => clienttranslate('{R} Choose one:  • <SABOTAGE>.  • Create a <MANASEED> token in your Landmarks. (It\'s a Permanent with \"{T}, Sacrifice me: Ready a Mana Orb.\")'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
