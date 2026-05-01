<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_QorganPhantom extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_118_C',
            'asset'  => 'ALT_EOLE_B_YZ_118_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Qorgan Phantom"),
      'typeline' => clienttranslate("Character - Mage"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jefrey Yonathan",
			'extension'=>'ROC',
   'subtypes'  => [MAGE],
 				'supportDesc' => clienttranslate('{D} : Draw a card, then discard a card from your hand. (Discard me from Reserve to do this.)'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
