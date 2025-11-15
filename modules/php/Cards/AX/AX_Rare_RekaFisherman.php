<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_RekaFisherman extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_94_R2',
            'asset'  => 'ALT_DUSTER_B_BR_94_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Reka Fisherman"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Haha, check it out, it\'s already stuffed!"'),
      'artist' => "Victor Canton",
			'extension'=>'SDU',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('#{R} Draw a card.#  {R} Create two <MANASEED> tokens in your Landmarks.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 4, 
     'costHand' => 3, 
     'costReserve' => 5, 
     'changedStats' => ['forest','mountain'], 
];
  }
}
