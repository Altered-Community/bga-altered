<?php
namespace ALT\Cards\OD;

class OD_Common_FieldReinforcements extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_43_C',
            'asset'  => 'ALT_ALIZE_B_OR_43_C',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Field Reinforcements"),
            'typeline' => clienttranslate("Spell - Conjuration Maneuver"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('Supply lines can sometimes be the difference between failure and success.'),
            'artist' => "Jean-Baptiste andrier",
			'extension'=>'TBF',
   'subtypes'  => [CONJURATION,MANEUVER],
 				'effectDesc' => clienttranslate('<FLEETING>.  Choose one. If each of your Expeditions is behind or tied, you may choose both:  • Draw a card.  • Create an <ORDIS_RECRUIT> Soldier token in target Expedition.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
