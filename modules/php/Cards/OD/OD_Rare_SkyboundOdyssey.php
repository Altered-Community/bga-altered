<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_SkyboundOdyssey extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_80_R1',
            'asset'  => 'ALT_CYCLONE_B_OR_80_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Skybound Odyssey"),
      'typeline' => clienttranslate("Spell - Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('Like a beacon, the horizon calls us onward!'),
      'artist' => "Matteo Spirito",
			'extension'=>'SO',
   'subtypes'  => [MANEUVER],
 				'effectDesc' => clienttranslate('Draw a card.  Both of your Expeditions <ASCEND>.  Immediately play for free up to #three Characters# with Base Cost {3} or less. (Reserve Cost if from Reserve, Hand Cost otherwise.)'),
     'costHand' => 7, 
     'costReserve' => 7, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
