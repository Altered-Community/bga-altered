<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_SylasCrypticWarlock extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_55_R2',
            'asset'  => 'ALT_BISE_B_YZ_55_R',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Sylas, Cryptic Warlock"),
            'typeline' => clienttranslate("Character - Mage"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Knowledge is power, but secrets are paramount.'),
            'artist' => "Zero Wen",
			'extension'=>'WFTM',
   'subtypes'  => [MAGE],
 				'effectDesc' => clienttranslate('{H} Draw a card.  #{J} I gain 1 boost per card in your hand.#'),
 				'supportDesc' => clienttranslate('{I} When #another Character joins your Expeditions# — I gain 1 boost, up to a max of 2.'),
 			     'supportIcon' => 'infinity',
     'forest' => 0, 
     'mountain' => 0, 
     'ocean' => 0, 
     'costHand' => 4, 
     'costReserve' => 4, 
     'changedStats' => ['forest','mountain','ocean','costReserve'], 
];
  }
}
