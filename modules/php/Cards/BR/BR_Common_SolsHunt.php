<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_SolsHunt extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_BR_78_C',
            'asset'  => 'ALT_CYCLONE_B_BR_78_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Sol's Hunt"),
      'typeline' => clienttranslate("Spell - Disruption"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('"I\'ll stop it before it sows death far and wide!" - Sol'),
      'artist' => "Justice Wong",
			'extension'=>'SO',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  Send target Character to Reserve.  You may <RUSH> to <SABOTAGE_INF>. (Rush means playing another card immediately. If you do, discard up to one target card from a Reserve.)'),
     'costHand' => 4, 
     'costReserve' => 4, 
 		'rush' => 'todo',
];
  }
}
