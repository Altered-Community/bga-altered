<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_WingsuitJumper extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_BR_72_R1',
            'asset'  => 'ALT_CYCLONE_B_BR_72_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Wingsuit Jumper"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('What\'s important is not the landing, but the fall.'),
      'artist' => "Justice Wong",
			'extension'=>'SO',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('#{H}# You may <RUSH> to draw a card. (Rush means playing another card immediately.)'),
 				'supportDesc' => clienttranslate('#{D} : The next Character you play this turn gains 1 boost.#'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
 		'rush' => 'todo',
];
  }
}
