<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_SkyboundOdyssey extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_80_C',
            'asset'  => 'ALT_CYCLONE_B_OR_80_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Skybound Odyssey"),
      'typeline' => clienttranslate("Spell - Maneuver"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('Like a beacon, the horizon calls us onward!'),
      'artist' => "Matteo Spirito",
			'extension'=>'SO',
   'subtypes'  => [MANEUVER],
 				'effectDesc' => clienttranslate('Draw a card.  Both of your Expeditions <ASCEND>. (Until Rest, they can move forward even if matched in their regions\' terrains by the opponent\'s Expeditions.)  Immediately play for free up to two Characters with Base Cost {3} or less. (Reserve Cost if from Reserve, Hand Cost otherwise.)'),
     'costHand' => 5, 
     'costReserve' => 6, 
];
  }
}
