<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_HelpfulDiver extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_88_C',
            'asset'  => 'ALT_DUSTER_B_BR_88_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Helpful Diver"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Ready for a shot of adrenaline?"'),
      'artist' => "Zero Wen",
			'extension'=>'SDU',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('{J} You may <RUSH>. If you don\'t, target opponent <EXHAUSTED_RESUPPLIES>. (They put the top card of their deck in Reserve, then they exhaust it {T}. Rush means playing another card immediately.)'),
     'forest' => 3, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
 		'rush' => 'todo',
];
  }
}
