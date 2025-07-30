<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_ForestNymph extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_71_R2',
            'asset'  => 'ALT_CYCLONE_B_LY_71_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Forest Nymph"),
      'typeline' => clienttranslate("Character - Fairy"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('From an innocent seed, she creates wild forests.'),
      'artist' => "HuoMiao Studio",
			'extension'=>'SO',
   'subtypes'  => [FAIRY],
 				'effectDesc' => clienttranslate('#{J}# If I\'m facing an Expedition in {V}, you may have target Character gain <FLEETING>.'),
     'forest' => 3, 
     'mountain' => 0, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
