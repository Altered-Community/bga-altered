<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_Kedarm extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_89_R2',
            'asset'  => 'ALT_DUSTER_B_BR_89_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Kedarm"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('One of the many amazing Chimaeras that inhabit the Sea of Tumult.'),
      'artist' => "Zael",
			'extension'=>'SDU',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('#When I go to Reserve from the Expedition zone — You may return another target Character from your Reserve to your hand.#'),
 				'supportDesc' => clienttranslate('{D} : The next Character played from your hand this turn activates one of its {r} abilities.'),
 			     'supportIcon' => 'discard',
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
