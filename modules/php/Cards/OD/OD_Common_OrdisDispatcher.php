<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_OrdisDispatcher extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_53_C',
            'asset'  => 'ALT_BISE_B_OR_53_C',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Ordis Dispatcher"),
            'typeline' => clienttranslate("Character - Soldier"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('She\'s in charge of every assignment within the garrison.'),
            'artist' => "Matteo Spirito",
			'extension'=>'WFTM',
   'subtypes'  => [SOLDIER],
 				'effectDesc' => clienttranslate('{R} You may spend 1 of my boosts to create one <ORDIS_RECRUIT> Soldier token in your other Expedition.'),
 				'supportDesc' => clienttranslate('{I} When another Character joins your Expeditions — I gain 1 boost, up to a max of 2.'),
 			     'supportIcon' => 'infinity',
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 4, 
];
  }
}
