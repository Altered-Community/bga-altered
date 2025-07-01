<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_AltrunTeammate extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_BR_67_R2',
            'asset'  => 'ALT_CYCLONE_B_BR_67_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Altrun Teammate"),
      'typeline' => clienttranslate("Character - Adventurer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Altrun is a running and obstacle-dodging discipline that comes in very handy on these islands.'),
      'artist' => "Ed Chee, S.Yong & Stephen",
			'extension'=>'SO',
   'subtypes'  => [ADVENTURER],
 				'effectDesc' => clienttranslate('{J} You may <RUSH> to give #target Character# 1 boost. (Rush means playing another card immediately.)'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['ocean'], 
 		'rush' => 'todo',
];
  }
}
