<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_KoiPlayfulLeviathan extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_74_R2',
            'asset'  => 'ALT_CYCLONE_B_LY_74_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Koi, Playful Leviathan"),
      'typeline' => clienttranslate("Character - Leviathan"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Its gracious leap parted the clouds, revealing our path forward.'),
      'artist' => "Zero Wen",
			'extension'=>'SO',
   'subtypes'  => [LEVIATHAN],
 				'effectDesc' => clienttranslate('$<GIGANTIC>.'),
     'forest' => 3, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 4, 
     'costReserve' => 4, 
 		'gigantic' => true,
];
  }
}
