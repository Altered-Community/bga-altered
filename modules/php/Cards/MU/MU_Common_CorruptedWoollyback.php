<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_CorruptedWoollyback extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_108_C',
            'asset'  => 'ALT_EOLE_B_MU_108_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Corrupted Woollyback"),
      'typeline' => clienttranslate("Character - Corruption Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zaeliven",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION,ANIMAL],
 				'effectDesc' => clienttranslate('{H} I gain <FLEETING> unless there\'s an Animal in an opponent\'s Expedition.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
