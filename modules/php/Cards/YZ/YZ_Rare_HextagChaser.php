<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_HextagChaser extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_YZ_87_R1',
            'asset'  => 'ALT_DUSTER_B_YZ_87_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Hextag Chaser"),
      'typeline' => clienttranslate("Character - Rogue"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('The element of surprise adds extra spice to any tactic.'),
      'artist' => "Damian Audino",
			'extension'=>'SDU',
   'subtypes'  => [ROGUE],
 				'effectDesc' => clienttranslate('{H} You may exhaust ({T}) target card in Reserve. If #it\'s in your Reserve,# <RESUPPLY_LOW>.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
