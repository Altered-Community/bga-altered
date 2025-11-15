<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_CheshireCat extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_91_R1',
            'asset'  => 'ALT_DUSTER_B_LY_91_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Cheshire Cat"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"We\'re all mad here."'),
      'artist' => "Taras Susak",
			'extension'=>'SDU',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} If I\'m <IN_CONTACT>, you may have target Character switch Expeditions. (I\'m In Contact if another player\'s Expedition is in my region.)'),
     'forest' => 3, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 2, 
     'changedStats' => ['forest','costReserve'], 
];
  }
}
