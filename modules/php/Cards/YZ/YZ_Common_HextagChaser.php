<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_HextagChaser extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_YZ_87_C',
            'asset'  => 'ALT_DUSTER_B_YZ_87_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Hextag Chaser"),
      'typeline' => clienttranslate("Character - Rogue"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('The element of surprise adds extra spice to any tactic.'),
      'artist' => "Damian Audino",
			'extension'=>'SDU',
   'subtypes'  => [ROGUE],
 				'effectDesc' => clienttranslate('{H} You may exhaust ({T}) target card in any player\'s Reserve. If it was the only card in their Reserve, they <RESUPPLY_THEY_S>. (Exhausted cards can\'t be played and have no Support abilities.)'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
