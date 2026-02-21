<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_Raij extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_106_R2',
            'asset'  => 'ALT_EOLE_B_BR_106_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Raij?"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jamin Amaral Fernandez",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} I gain <FLEETING>.'),
     'forest' => 2, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
