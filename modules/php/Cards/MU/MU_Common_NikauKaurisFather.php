<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_NikauKaurisFather extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_112_C',
            'asset'  => 'ALT_EOLE_B_MU_112_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Nikau, Kauri's Father"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Kevin Sidharta",
			'extension'=>'ROC',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('When an Animal joins your Expeditions — I gain 1 boost, up to a max of 2.'),
     'forest' => 0, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
