<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_KarhuLordofBears extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_113_C',
            'asset'  => 'ALT_EOLE_B_MU_113_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Karhu, Lord of Bears"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Matteo Spirito",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} If you control another Animal, draw a card.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
