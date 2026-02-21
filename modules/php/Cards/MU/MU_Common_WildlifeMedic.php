<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_WildlifeMedic extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_116_C',
            'asset'  => 'ALT_EOLE_B_MU_116_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Wildlife Medic"),
      'typeline' => clienttranslate("Character - Druid"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zaeliven",
			'extension'=>'ROC',
   'subtypes'  => [DRUID],
 				'effectDesc' => clienttranslate('{H} <RESUPPLY>. If you put an Animal in Reserve this way, it gains 1 boost.'),
     'forest' => 3, 
     'mountain' => 0, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
