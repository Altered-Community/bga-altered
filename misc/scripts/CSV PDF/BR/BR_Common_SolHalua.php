<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_SolHalua extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_65_C',
            'asset'  => 'ALT_DUSTER_B_BR_65_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Sol & Halua"),
      'typeline' => clienttranslate("Bravos Hero"),
    	'type'  => HERO,
    	'flavorText'  => clienttranslate('Hate is a spear pointed at one\'s own heart'),
      'artist' => "Tristan Bideau",
			'extension'=>'SDU',
   				'effectDesc' => clienttranslate('When you pass first — I gain 1 Quest counter. Then, if I have 3 or more Quest counters, create a <HALUA> Leviathan Companion token in your Companion Expedition. (It has \"If your Hero has 5 or more Quest counters, I am Gigantic.\")'),
];
  }
}
