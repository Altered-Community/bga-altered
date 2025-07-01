<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_TheOperaHouse extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_82_C',
            'asset'  => 'ALT_CYCLONE_B_LY_82_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("The Opera House"),
      'typeline' => clienttranslate("Landmark_permanent - Construction"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('The Arkaster Opera House is known as the Spark, for that\'s where stars are born.'),
      'artist' => "Ba Vo",
			'extension'=>'SO',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('{T} : Reveal the top card of your deck. If it\'s a Spell, draw it. (Otherwise, leave it on top of your deck.)'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
