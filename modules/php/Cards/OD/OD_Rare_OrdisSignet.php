<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_OrdisSignet extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_78_R1',
            'asset'  => 'ALT_CYCLONE_B_OR_78_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Ordis Signet"),
      'typeline' => clienttranslate("Spell - Conjuration"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('Cohesion and justice.'),
      'artist' => "Zero Wen",
			'extension'=>'SO',
   'subtypes'  => [CONJURATION],
 				'effectDesc' => clienttranslate('#<FLEETING>.#  Choose #two:#  • Target Character gains <ASLEEP>.  • Target Character in Expedition or in Reserve loses all its boosts.  • Each Character in target Expedition gains 1 boost.'),
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
