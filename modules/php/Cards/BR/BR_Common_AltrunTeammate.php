<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_AltrunTeammate extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_BR_67_C',
            'asset'  => 'ALT_CYCLONE_B_BR_67_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Altrun Teammate"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Altrun is a running and obstacle-dodging discipline that comes in very handy on these islands.'),
      'artist' => "Ed Chee, S.Yong & Stephen",
			'extension'=>'SO',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('{J} You may <RUSH> to give me 1 boost. (Rush means playing another card immediately.)'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
 		'rush' => 'todo',
];
  }
}
