<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_RekaBarmaid extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_89_R1',
            'asset'  => 'ALT_DUSTER_B_LY_89_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Reka Barmaid"),
      'typeline' => clienttranslate("Character - Artist"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"It\'s happy hour all the time here!"'),
      'artist' => "Zero Wen",
			'extension'=>'SDU',
   'subtypes'  => [ARTIST],
 				'effectDesc' => clienttranslate('At Dusk — If I\'m <IN_CONTACT>, I gain 1 boost. (I\'m In Contact if another player\'s Expedition is in my region.)'),
 				'supportDesc' => clienttranslate('#{D} : The next Character you play this turn gains 1 boost.#'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['forest'], 
];
  }
}
