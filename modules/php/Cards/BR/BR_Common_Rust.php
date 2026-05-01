<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_Rust extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_123_C',
            'asset'  => 'ALT_EOLE_B_BR_123_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Rust"),
      'typeline' => clienttranslate("Token - Companion"),
    	'type'  => TOKEN,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Tristan Bideau",
			'extension'=>'ROC',
   'subtypes'  => [COMPANION],
 				'effectDesc' => clienttranslate('{J} I gain 1 boost per <COMPLETED_LOW> Feat in your Landmarks.'),
     'forest' => 0, 
     'mountain' => 0, 
     'ocean' => 0, 
];
  }
}
