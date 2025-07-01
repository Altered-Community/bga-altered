<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_ArmoredBird extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_MU_69_C',
            'asset'  => 'ALT_CYCLONE_B_MU_69_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Armored Bird"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('He raised a shield of feathers. Lances and harpoons shattered against his steely wings.'),
      'artist' => "Victor Canton",
			'extension'=>'SO',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('$<DEFENDER>.'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 5, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
