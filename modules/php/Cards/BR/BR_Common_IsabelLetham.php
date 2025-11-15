<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_IsabelLetham extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_90_C',
            'asset'  => 'ALT_DUSTER_B_BR_90_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Isabel Letham"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('The lowest point of the wave is where she draws all her strength.'),
      'artist' => "HuoMiao Studio",
			'extension'=>'SDU',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('{R} You may <RUSH> to <RESUPPLY_INF>. (Rush means playing another card immediately.)'),
     'forest' => 3, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 3, 
 		'rush' => 'todo',
];
  }
}
