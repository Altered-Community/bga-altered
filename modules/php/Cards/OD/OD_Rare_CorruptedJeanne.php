<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_CorruptedJeanne extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_114_R1',
            'asset'  => 'ALT_EOLE_B_OR_114_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Corrupted Jeanne"),
      'typeline' => clienttranslate("Character - Corruption Soldier"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Tristan Bideau",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION,SOLDIER],
 				'effectDesc' => clienttranslate('#I can\'t be played# unless there\'s another Character in each of your Expeditions.  When I leave the Expedition zone — Create an <ORDIS_RECRUIT> Soldier token in each of your Expeditions.'),
 				'supportDesc' => clienttranslate('#{D} : Create an <ORDIS_RECRUIT> Soldier token in target Expedition.#'),
 			     'supportIcon' => 'discard',
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['forest','mountain','ocean'], 
];
  }
}
