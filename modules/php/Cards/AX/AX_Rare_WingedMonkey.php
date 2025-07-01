<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_WingedMonkey extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_YZ_67_R2',
            'asset'  => 'ALT_CYCLONE_B_YZ_67_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Winged Monkey"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Flight should always mean freedom.'),
      'artist' => "Anh Tung",
			'extension'=>'SO',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} I gain 2 boosts, #then create an <AEROLITH> token in target player\'s Landmarks.#'),
     'forest' => 0, 
     'mountain' => 2, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 1, 
];
  }
}
