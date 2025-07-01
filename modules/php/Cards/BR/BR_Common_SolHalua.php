<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_SolHalua extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_BR_65_C',
            'asset'  => 'ALT_CYCLONE_B_BR_65_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Sol & Halua"),
      'typeline' => clienttranslate("Hero - 0"),
    	'type'  => HERO,
    	'flavorText'  => clienttranslate('Hate is a spear pointed at one\'s own heart'),
      'artist' => "Tristan Bideau",
			'extension'=>'SO',
   'subtypes'  => [0],
 				'effectDesc' => clienttranslate('When you pass first (stop taking turns before other players) — I gain 1 Quest counter. Then, if I have 3 or more Quest counters, create a <HALUA> token in your Companion Expedition. (It\'s a Leviathan Companion token with \"If your Hero has 5 or more Quest counters, I am Gigantic.\")'),
     'costHand' => 0, 
     'costReserve' => 0, 
];
  }
}
