<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_ColorfulCuckoo extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_MU_70_C',
            'asset'  => 'ALT_CYCLONE_B_MU_70_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Colorful Cuckoo"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Even the shyest become a bit less reserved when they hear its song.'),
      'artist' => "Seppyo",
			'extension'=>'SO',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{J} I gain $<ANCHORED>.  When a Character joins the Expedition facing me — I gain 1 boost.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
