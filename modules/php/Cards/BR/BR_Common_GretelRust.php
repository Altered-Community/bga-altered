<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_GretelRust extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_105_C',
            'asset'  => 'ALT_EOLE_B_BR_105_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Gretel & Rust"),
      'typeline' => clienttranslate("Bravos Hero"),
    	'type'  => HERO,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Tristan Bideau",
			'extension'=>'ROC',
   				'effectDesc' => clienttranslate('(Keep up to three cards in your Landmarks during Night.)  At Noon — If you control a Feat, create a <RUST> token in your Companion Expedition. (It\'s a Companion with \"{J} I gain 1 boost per Completed Feat in your Landmarks\".)'),
];
  }
}
