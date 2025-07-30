<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_Melusine extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_70_C',
            'asset'  => 'ALT_CYCLONE_B_OR_70_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Melusine"),
      'typeline' => clienttranslate("Character - Fairy"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Every broken promise demands retribution.'),
      'artist' => "Zael",
			'extension'=>'SO',
   'subtypes'  => [FAIRY],
 				'effectDesc' => clienttranslate('{H} If I\'m in an Ascended Expedition, <SABOTAGE_LOW>. Otherwise, my Expedition <ASCENDS>. (Until Rest, it can move forward even if matched in its region\'s terrains by the opponent\'s Expedition.)'),
     'forest' => 0, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
