<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_YannaQorganAgent extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_75_C',
            'asset'  => 'ALT_CYCLONE_B_OR_75_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Yanna, Qorgan Agent"),
      'typeline' => clienttranslate("Character - Bureaucrat Mage"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Spies from the Qorgan infiltrate the Factions and steal their secrets.'),
      'artist' => "Ba Vo",
			'extension'=>'SO',
   'subtypes'  => [BUREAUCRAT,MAGE],
 				'effectDesc' => clienttranslate('{J} You may have target Character gain <ASLEEP>. (During Dusk, ignore its statistics. During Rest, it doesn\'t go to Reserve and loses Asleep.)'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 5, 
     'costReserve' => 5, 
];
  }
}
