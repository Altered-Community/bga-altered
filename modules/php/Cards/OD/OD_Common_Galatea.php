<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_Galatea extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_88_C',
            'asset'  => 'ALT_DUSTER_B_OR_88_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Galatea"),
      'typeline' => clienttranslate("Character - Elemental"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('If a sculptor merely frees the form from the stone, then it never belonged to him in the first place.'),
      'artist' => "Nestor Papatriantafyllou",
			'extension'=>'SDU',
   'subtypes'  => [ELEMENTAL],
 				'effectDesc' => clienttranslate('If I\'m <IN_CONTACT>, I\'m <DEFENDER_FS>. (My Expedition can\'t move forward during Dusk. I\'m In Contact if another player\'s Expedition is in my region.)  {J} If I\'m <IN_CONTACT>, I gain 2 boosts.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
