<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_TotingArmadillo extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_110_R2',
            'asset'  => 'ALT_EOLE_B_AX_110_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Toting Armadillo"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} Pay {1} less for the next Permanent you play this Afternoon, down to a minimum of {1}.'),
     'forest' => 0, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 1, 
     'changedStats' => ['costReserve'], 
];
  }
}
