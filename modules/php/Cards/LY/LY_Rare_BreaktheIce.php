<?php
namespace ALT\Cards\LY;

class LY_Rare_BreaktheIce extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_42_R1',
            'asset'  => 'ALT_ALIZE_B_LY_42_R',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Break the Ice"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('Well, they didn\'t mean literally.'),
            'artist' => "HuoMiao Studio",
			'extension'=>'TBF',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('#$<COOLDOWN>#.  I cost {2} less if you have three or more base statistics of 0 among Characters you control.  Send target Character to Reserve, then exhaust it ({T}).'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
