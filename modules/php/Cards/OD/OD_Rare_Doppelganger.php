<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_Doppelganger extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_73_R1',
            'asset'  => 'ALT_CYCLONE_B_OR_73_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Doppelgänger"),
      'typeline' => clienttranslate("Character - Elemental"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Such fluidity reflects countless possibilities.'),
      'artist' => "Huo Miao Studio",
			'extension'=>'SO',
   'subtypes'  => [ELEMENTAL],
 				'effectDesc' => clienttranslate('#$<SEASONED>.#  #{H}# Target a Character facing me. I gain its subtypes and X boosts, where X equals its highest statistic. (I lose these subtypes when I leave the Expedition zone.)'),
     'forest' => 0, 
     'mountain' => 0, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['costHand','costReserve'], 
 		'seasoned' => true,
];
  }
}
