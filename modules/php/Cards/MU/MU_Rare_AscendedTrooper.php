<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_AscendedTrooper extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_67_R2',
            'asset'  => 'ALT_CYCLONE_B_OR_67_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Ascended Trooper"),
      'typeline' => clienttranslate("Character - Soldier"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('After months of expeditions, Aedyt felt she had finally spread her wings.'),
      'artist' => "Jefrey Yonathan",
			'extension'=>'SO',
   'subtypes'  => [SOLDIER],
 				'effectDesc' => clienttranslate('#{J}# If I\'m in an Ascended Expedition, I gain 1 boost. Otherwise, my Expedition <ASCENDS>.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
