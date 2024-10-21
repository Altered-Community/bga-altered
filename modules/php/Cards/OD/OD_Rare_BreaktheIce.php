<?php
namespace ALT\Cards\OD;

class OD_Rare_BreaktheIce extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_42_R2',
            'asset'  => 'ALT_ALIZE_B_LY_42_R2',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Break the Ice"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('Well, they didn\'t mean literally.'),
            'artist' => "HuoMiao Studio",
			'extension'=>'TBF',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  I cost {2} less if #you control three or more Characters#.  Send target Character to Reserve, then exhaust it ({T}). (Exhausted cards can\'t be played and have no Support abilities.)'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
