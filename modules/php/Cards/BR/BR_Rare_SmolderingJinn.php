<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_SmolderingJinn extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_BR_68_R1',
            'asset'  => 'ALT_CYCLONE_B_BR_68_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Smoldering Jinn"),
      'typeline' => clienttranslate("Character - Elemental"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Fire is always smoldering in the idea of the ember.'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SO',
   'subtypes'  => [ELEMENTAL],
 				'effectDesc' => clienttranslate('{R} #You may <RUSH> to# put the top card of your deck in your Mana zone, exhausted. (Rush means playing another card immediately.)'),
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 3, 
     'changedStats' => ['costReserve'], 
 		'rush' => 'todo',
];
  }
}
