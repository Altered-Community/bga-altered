<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_ScienceFair extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_100_R1',
            'asset'  => 'ALT_DUSTER_B_AX_100_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Science Fair"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('At this convention, the Reka show off their scientific superiority.'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SDU',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('#{J} Exhaust me.#  {T} : Put a card from your hand in Reserve, #then exhaust it ({T}).# If you do, draw a card.'),
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
