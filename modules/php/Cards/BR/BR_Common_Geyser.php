<?php
namespace ALT\Cards\BR;

class BR_Common_Geyser extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_42_C',
            'asset'  => 'ALT_ALIZE_B_BR_42_C',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_COMMON,
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
