<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_HaluaRagingLeviathan extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_BR_77_R1',
            'asset'  => 'ALT_CYCLONE_B_BR_77_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Halua, Raging Leviathan"),
      'typeline' => clienttranslate("Character - Leviathan"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Its fury blocked our path.'),
      'artist' => "Tristan Bideau",
			'extension'=>'SO',
   'subtypes'  => [LEVIATHAN],
 				'effectDesc' => clienttranslate('<GIGANTIC>, <TOUGH_1>.  At Dusk — Each #other# Character gains <FLEETING>.'),
 				'supportDesc' => clienttranslate('#{D} : Draw a card.#'),
 			     'supportIcon' => 'discard',
     'forest' => 5, 
     'mountain' => 5, 
     'ocean' => 5, 
     'costHand' => 7, 
     'costReserve' => 7, 
 		'gigantic' => true,
 		'tough'=>1,
];
  }
}
