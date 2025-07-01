<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_Undine extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_YZ_66_R2',
            'asset'  => 'ALT_CYCLONE_B_YZ_66_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Undine"),
      'typeline' => clienttranslate("Character - Elemental"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('When Yzmir alchemists call on the water spirit, the mischievous undine responds.'),
      'artist' => "Leena Sooba",
			'extension'=>'SO',
   'subtypes'  => [ELEMENTAL],
 				'supportDesc' => clienttranslate('{D} : The next Spell you play this turn loses <FLEETING>.'),
 			     'supportIcon' => 'discard',
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 1, 
     'changedStats' => ['forest','mountain'], 
];
  }
}
