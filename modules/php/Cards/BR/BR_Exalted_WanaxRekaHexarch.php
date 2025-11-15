<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Exalted_WanaxRekaHexarch extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_98_E',
            'asset'  => 'ALT_DUSTER_B_BR_98_E',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_EXALTED,
    	'name'  => clienttranslate("Wanax, Reka Hexarch"),
      'typeline' => clienttranslate("Character - Noble"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"I\'ll show you how to work without a net!"'),
      'artist' => "Taras Susak",
			'extension'=>'SDU',
   'subtypes'  => [NOBLE],
 				'effectDesc' => clienttranslate('Play me for {1} less per other card you played this turn.  {J} Pass. (Don\'t take any more turns this Day.)'),
     'forest' => 6, 
     'mountain' => 6, 
     'ocean' => 6, 
     'costHand' => 5, 
     'costReserve' => 5, 
];
  }
}
