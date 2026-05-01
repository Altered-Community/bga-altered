<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_LyraFifer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_109_R1',
            'asset'  => 'ALT_EOLE_B_LY_109_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Lyra Fifer"),
      'typeline' => clienttranslate("Character - Artist"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   'subtypes'  => [ARTIST],
 				'effectDesc' => clienttranslate('{J} If a {D} ability #was activated this turn,# I gain 1 boost.'),
 				'supportDesc' => clienttranslate('#{D} : The next Character you play this turn gains 1 boost.#'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['mountain','ocean'], 
];
  }
}
