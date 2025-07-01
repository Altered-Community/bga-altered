<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_MountainGuide extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_66_R2',
            'asset'  => 'ALT_CYCLONE_B_LY_66_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Mountain Guide"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Who better than a groundhog to wind their way through these hanging rice fields?'),
      'artist' => "Ba Vo",
			'extension'=>'SO',
   'subtypes'  => [ANIMAL],
 				'supportDesc' => clienttranslate('#{D} : The next card you play this turn costs {1} less.#'),
 			     'supportIcon' => 'discard',
     'forest' => 0, 
     'mountain' => 4, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['mountain','costHand','costReserve'], 
];
  }
}
