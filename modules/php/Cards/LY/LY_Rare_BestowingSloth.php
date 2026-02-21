<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_BestowingSloth extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_113_R1',
            'asset'  => 'ALT_EOLE_B_LY_113_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Bestowing Sloth"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} I gain <ASLEEP>.  #At Noon — <RESUPPLY>.#'),
 				'supportDesc' => clienttranslate('{D} : <AFTER_YOU>.'),
 			     'supportIcon' => 'discard',
     'forest' => 3, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 3, 
     'changedStats' => ['mountain'], 
];
  }
}
