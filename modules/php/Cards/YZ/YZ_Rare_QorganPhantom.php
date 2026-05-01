<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_QorganPhantom extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_118_R1',
            'asset'  => 'ALT_EOLE_B_YZ_118_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Qorgan Phantom"),
      'typeline' => clienttranslate("Character - Mage"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jefrey Yonathan",
			'extension'=>'ROC',
   'subtypes'  => [MAGE],
 				'effectDesc' => clienttranslate('#{H} You may pay {1}. If you do, I activate my {D} ability.#'),
 				'supportDesc' => clienttranslate('{D} : Draw a card, then discard a card from your hand.'),
 			     'supportIcon' => 'discard',
     'forest' => 3, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['forest'], 
];
  }
}
