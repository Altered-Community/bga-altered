<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_FarFetch20 extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_69_C',
            'asset'  => 'ALT_CYCLONE_B_AX_69_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("FarFetch 2.0"),
      'typeline' => clienttranslate("Character - Robot"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"I\'m glad I got my hooks into this new version!" - Paju'),
      'artist' => "Zael",
			'extension'=>'SO',
   'subtypes'  => [ROBOT],
 				'effectDesc' => clienttranslate('{J} You may sacrifice a Permanent. If you do, target Character switches Expeditions. (It leaves its Expedition and joins its controller\'s other Expedition.)'),
     'forest' => 3, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
