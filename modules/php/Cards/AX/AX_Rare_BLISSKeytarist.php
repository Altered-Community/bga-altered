<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_BLISSKeytarist extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_52_R2',
            'asset'  => 'ALT_BISE_B_LY_52_R',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("BLISS Keytarist"),
            'typeline' => clienttranslate("Character - Artist"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('"Make some noise for all the brave folks pulling Sap up from the depths!" — Orbec'),
            'artist' => "Zero Wen",
			'extension'=>'WFTM',
   'subtypes'  => [ARTIST],
 				'effectDesc' => clienttranslate('At Dusk — If I\'m <BOOSTED>, reveal the top card of your deck. If it\'s a #Robot# or #Permanent#, draw it. Otherwise, discard it.'),
 				'supportDesc' => clienttranslate('{I} #At Noon — Choose one:# • I gain 1 boost, up to a #max of 3.# • #{T} : I gain 2 boosts, up to a max of 3.#'),
 			     'supportIcon' => 'infinity',
     'forest' => 2, 
     'mountain' => 0, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 3, 
];
  }
}
