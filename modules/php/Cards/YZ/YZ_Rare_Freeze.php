<?php
namespace ALT\Cards\YZ;

class YZ_Rare_Freeze extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_40_R1',
            'asset'  => 'ALT_ALIZE_B_YZ_40_R',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Freeze"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('"I\'m putting you on ice!"'),
            'artist' => "HuoMiao Studio",
			'extension'=>'TBF',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('$<COOLDOWN>.  Send target Character to Reserve, then exhaust it ({T}).'),
     'costHand' => 3, 
     'costReserve' => 4, 
     'changedStats' => ['costHand'], 
];
  }
}
