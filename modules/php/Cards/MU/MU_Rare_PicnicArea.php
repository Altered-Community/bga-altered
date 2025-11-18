<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_PicnicArea extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_MU_100_R1',
            'asset'  => 'ALT_DUSTER_B_MU_100_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Picnic Area"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('Just good, casual feasting.'),
      'artist' => "Kevin Sidharta",
			'extension'=>'SDU',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Each player #draws a card.#  When you make a <GIFT> — You may exhaust me ({T}) to have target Character gain 1 boost.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
