<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_CorruptedWoollyback extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_108_R1',
            'asset'  => 'ALT_EOLE_B_MU_108_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Corrupted Woollyback"),
      'typeline' => clienttranslate("Character - Corruption Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zaeliven",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION,ANIMAL],
 				'effectDesc' => clienttranslate('#I can\'t be played# unless there\'s an Animal in an opponent\'s Expedition.  #When I leave the Expedition zone — Create a <WOOLLYBACK> Animal token in my Expedition.#'),
     'forest' => 1, 
     'mountain' => 0, 
     'ocean' => 0, 
     'costHand' => 1, 
     'costReserve' => 1, 
     'changedStats' => ['mountain','ocean'], 
];
  }
}
