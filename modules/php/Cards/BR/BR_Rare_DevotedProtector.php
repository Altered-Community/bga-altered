<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_DevotedProtector extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_110_R1',
            'asset'  => 'ALT_EOLE_B_BR_110_R',

    	'faction'  => FACTION_BR,
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
     'effectReserve' => FT::ACTION(CHECK_CONDITION, [
      'condition' => 'hasControl:feat:1',
      'effect' => FT::GAIN(ME, BOOST),
    ]),
];
  }
}
