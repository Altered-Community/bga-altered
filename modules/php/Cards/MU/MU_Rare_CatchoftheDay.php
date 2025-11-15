<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_CatchoftheDay extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_100_R2',
            'asset'  => 'ALT_DUSTER_B_BR_100_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Catch of the Day"),
      'typeline' => clienttranslate("Spell - Disruption"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('There\'s no slipping through the net this time.'),
      'artist' => "DOBA",
			'extension'=>'SDU',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('Return target Character or Permanent controlled by another player to its owner\'s hand.  Then, create a <MANASEED> token in that player\'s Landmarks.'),
     'costHand' => 2, 
     'costReserve' => 4, 
];
  }
}
