<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_QorganPhantom extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_118_R2',
            'asset'  => 'ALT_EOLE_B_YZ_118_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Qorgan Phantom"),
      'typeline' => clienttranslate("Character - Mage"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jefrey Yonathan",
			'extension'=>'ROC',
   'subtypes'  => [MAGE],
 				'supportDesc' => clienttranslate('{D} : Draw a card, then #put a card from your hand in Reserve.#'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
