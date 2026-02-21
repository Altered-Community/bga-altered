<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_MoltingCrab extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_110_C',
            'asset'  => 'ALT_EOLE_B_YZ_110_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Molting Crab"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Fahmi Fauzi",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} Draw a card, then discard a card from your hand.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 4, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
