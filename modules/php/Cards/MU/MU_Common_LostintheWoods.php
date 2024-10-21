<?php
namespace ALT\Cards\MU;

class MU_Common_LostintheWoods extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_42_C',
            'asset'  => 'ALT_ALIZE_B_MU_42_C',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Lost in the Woods"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('They\'re not out of the woods yet.'),
            'artist' => "HuoMiao Studio",
			'extension'=>'TBF',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  Choose one:  • Send target Character in {V} to Reserve.  • Discard target Permanent.'),
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
