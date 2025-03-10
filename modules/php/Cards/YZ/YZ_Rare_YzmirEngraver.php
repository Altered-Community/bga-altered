<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_YzmirEngraver extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_50_R1',
            'asset'  => 'ALT_BISE_B_YZ_50_R',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Yzmir Engraver"),
            'typeline' => clienttranslate("Character - Artist Mage"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('By mixing Sap into the ink, the power of the Sigils is augmented tenfold.'),
            'artist' => "Zero Wen",
			'extension'=>'WFTM',
   'subtypes'  => [ARTIST,MAGE],
 				'effectDesc' => clienttranslate('{R} You may spend 1 of my boosts to #discard target Character or Permanent# with Hand Cost {2} or less.'),
 				'supportDesc' => clienttranslate('{I} When you play a Spell — I gain 1 boost, up to a max of 2.'),
 			     'supportIcon' => 'infinity',
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 3, 
];
  }
}
