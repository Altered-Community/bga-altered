<?php
namespace ALT\Cards\BR;

class BR_Common_Amarok extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_39_C',
            'asset'  => 'ALT_ALIZE_B_BR_39_C',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Amarok"),
            'typeline' => clienttranslate("Character - Animal"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('The lone wolf guards its territory jealously.'),
            'artist' => "Matteo Spirito",
			'extension'=>'TBF',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('If there are no Characters in the Expedition I\'m played in, I cost {2} less.  When another Character joins my Expedition — Sacrifice it.'),
     'forest' => 4, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 5, 
     'costReserve' => 5, 
];
  }
}
