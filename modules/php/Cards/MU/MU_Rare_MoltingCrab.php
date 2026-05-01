<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_MoltingCrab extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_110_R2',
            'asset'  => 'ALT_EOLE_B_YZ_110_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Molting Crab"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Fahmi Fauzi",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('#{J}# Draw a card, then discard a card from your hand.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 4, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['forest','mountain'], 
];
  }
}
