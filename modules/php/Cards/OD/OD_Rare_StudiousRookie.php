<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_StudiousRookie extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_YZ_88_R2',
            'asset'  => 'ALT_DUSTER_B_YZ_88_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Studious Rookie"),
      'typeline' => clienttranslate("Character - Mage Scholar"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Maleros should have been wary of the outsider.'),
      'artist' => "HuoMiao Studio",
			'extension'=>'SDU',
   'subtypes'  => [MAGE,SCHOLAR],
 				'effectDesc' => clienttranslate('When you play a #Permanent# with Base Cost {4} or more — #I gain 1 boost.# (It\'s the Reserve Cost if played from Reserve, or the Hand Cost if not.)'),
     'forest' => 0, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 1, 
     'changedStats' => ['mountain'], 
];
  }
}
