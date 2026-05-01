<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_RekaScavenger extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_109_R2',
            'asset'  => 'ALT_EOLE_B_AX_109_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Reka Scavenger"),
      'typeline' => clienttranslate("Character - Engineer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
			'extension'=>'ROC',
   'subtypes'  => [ENGINEER],
 				'effectDesc' => clienttranslate('When you pass — If your hand #is empty,# I gain #2 boosts.#'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['forest'], 
     'effectPassive' => [
      'EndTurn' => [
        [
          'conditions' => ['isMe', 'isHandEmpty'],
          'output' => FT::GAIN(ME, BOOST, 2),
        ],
      ],
    ],
];
  }
}
