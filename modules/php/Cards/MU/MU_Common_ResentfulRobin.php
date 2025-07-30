<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_ResentfulRobin extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_MU_66_C',
            'asset'  => 'ALT_CYCLONE_B_MU_66_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Resentful Robin"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Despite their small size, Rhodopean robins will defend their territory with beak and claw.'),
      'artist' => "Anh Tung",
			'extension'=>'SO',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{J} If I\'m facing a Character, I gain 1 boost.'),
     'forest' => 1, 
     'mountain' => 0, 
     'ocean' => 0, 
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
