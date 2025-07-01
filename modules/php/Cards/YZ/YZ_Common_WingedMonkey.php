<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_WingedMonkey extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_YZ_67_C',
            'asset'  => 'ALT_CYCLONE_B_YZ_67_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Winged Monkey"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Flight should always mean freedom.'),
      'artist' => "Anh Tung",
			'extension'=>'SO',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} I gain 2 boosts.'),
     'forest' => 0, 
     'mountain' => 2, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 1, 
];
  }
}
