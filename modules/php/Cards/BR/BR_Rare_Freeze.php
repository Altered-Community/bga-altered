<?php
namespace ALT\Cards\BR;

class BR_Rare_Freeze extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_40_R2',
            'asset'  => 'ALT_ALIZE_B_YZ_40_R2',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Freeze"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('"I\'m putting you on ice!"'),
            'artist' => "HuoMiao Studio",
			'extension'=>'TBF',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('$<COOLDOWN>.  Send target Character to Reserve, then exhaust it ({T}).'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
