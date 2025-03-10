<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_CuppaSap extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_60_C',
            'asset'  => 'ALT_BISE_B_BR_60_C',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Cuppa Sap"),
            'typeline' => clienttranslate("Spell - Boon"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('Sap beverages may not be everyone\'s cup of tea, but they sure perk you up!'),
            'artist' => "Ed Chee, S.Yong & Stephen",
			'extension'=>'WFTM',
   'subtypes'  => [BOON],
 				'effectDesc' => clienttranslate('Target Character in Reserve gains 2 boosts.'),
     'costHand' => 1, 
     'costReserve' => 2, 
];
  }
}
