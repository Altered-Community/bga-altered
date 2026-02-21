<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_DevotedProtector extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_110_R2',
            'asset'  => 'ALT_EOLE_B_BR_110_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Devoted Protector"),
      'typeline' => clienttranslate("Character - Soldier"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Martin Mottet",
			'extension'=>'ROC',
   'subtypes'  => [SOLDIER],
 				'effectDesc' => clienttranslate('#{R} If you control a Feat, I gain 1 boost.#'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 1, 
     'changedStats' => ['forest'], 
];
  }
}
