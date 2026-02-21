<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_StigmaofBelligerence extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_117_C',
            'asset'  => 'ALT_EOLE_B_MU_117_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Stigma of Belligerence"),
      'typeline' => clienttranslate("Character - Corruption Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zaeliven",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION,ANIMAL],
 				'effectDesc' => clienttranslate('{H} If I\'m facing one or more Characters, target one of them and we both gain <ANCHORED>.'),
     'forest' => 3, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
