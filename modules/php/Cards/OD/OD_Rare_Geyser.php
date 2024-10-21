<?php
namespace ALT\Cards\OD;

class OD_Rare_Geyser extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_42_R2',
            'asset'  => 'ALT_ALIZE_B_BR_42_R2',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Geyser"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('Under pressure!'),
            'artist' => "Jean-Baptiste Andrier",
			'extension'=>'TBF',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('Return target Character or Permanent to its owner\'s hand, then put me in your Mana Orbs (as an exhausted Mana Orb).'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
