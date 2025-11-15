<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_Galatea extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_88_R1',
            'asset'  => 'ALT_DUSTER_B_OR_88_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Galatea"),
      'typeline' => clienttranslate("Character - Elemental"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('If a sculptor merely frees the form from the stone, then it never belonged to him in the first place.'),
      'artist' => "Nestor Papatriantafyllou",
			'extension'=>'SDU',
   'subtypes'  => [ELEMENTAL],
 				'effectDesc' => clienttranslate('I\'m <DEFENDER_FS>.  #If my Expedition is <IN_CONTACT>, <DEFENDER_CHA_P> Characters don\'t prevent it from moving forward.# (I\'m In Contact if another player\'s Expedition is in my region.)'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['forest','mountain','ocean'], 
];
  }
}
