<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_HelpfulDiver extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_88_R1',
            'asset'  => 'ALT_DUSTER_B_BR_88_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Helpful Diver"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Ready for a shot of adrenaline?"'),
      'artist' => "Zero Wen",
			'extension'=>'SDU',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('{J} You may <RUSH>. If you don\'t, target opponent <EXHAUSTED_RESUPPLIES>. (Rush means playing another card immediately.)'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['mountain','ocean'], 
 		'rush' => 'todo',
];
  }
}
