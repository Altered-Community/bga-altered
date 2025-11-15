<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_RekaSupporter extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_YZ_91_R1',
            'asset'  => 'ALT_DUSTER_B_YZ_91_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Reka Supporter"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('The energy of the crowd is what drives the greatest victories.'),
      'artist' => "Zero Wen",
			'extension'=>'SDU',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('{H} Create a <MANASEED> token in your Landmarks.'),
 				'supportDesc' => clienttranslate('#{D} : <AFTER_YOU>.#'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 2, 
     'changedStats' => ['ocean'], 
];
  }
}
