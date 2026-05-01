<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_TotingArmadillo extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_110_C',
            'asset'  => 'ALT_EOLE_B_AX_110_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Toting Armadillo"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} Pay {1} less for the next Permanent you play this Afternoon, down to a minimum of {1}. (Other effects may reduce it further.)'),
     'forest' => 0, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'effectHand' => [
      'action' => SPECIAL_EFFECT,
      'args' => ['effect' => 'costReduction', 'args' => ['type' => PERMANENT, 'reduction' => 1, 'minimum' => 1, 'permanent' => true]],
    ],
];
  }
}
