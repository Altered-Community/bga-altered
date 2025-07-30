<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_KoiPlayfulLeviathan extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_74_C',
            'asset'  => 'ALT_CYCLONE_B_LY_74_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
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
