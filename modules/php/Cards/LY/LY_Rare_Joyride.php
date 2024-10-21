<?php
namespace ALT\Cards\LY;

class LY_Rare_Joyride extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_40_R1',
            'asset'  => 'ALT_ALIZE_B_LY_40_R',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Joyride"),
            'typeline' => clienttranslate("Spell - Maneuver"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('Everything fun is life is either forbidden or completely crazy.'),
            'artist' => "Justice Wong",
			'extension'=>'TBF',
   'subtypes'  => [MANEUVER],
 				'effectDesc' => clienttranslate('Discard another card from your Reserve. If you do, target Character gains 2 boosts.'),
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
