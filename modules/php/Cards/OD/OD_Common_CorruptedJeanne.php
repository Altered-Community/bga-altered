<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_CorruptedJeanne extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_114_C',
            'asset'  => 'ALT_EOLE_B_OR_114_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Corrupted Jeanne"),
      'typeline' => clienttranslate("Character - Corruption Soldier"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Tristan Bideau",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION,SOLDIER],
 				'effectDesc' => clienttranslate('{H} I gain <FLEETING> unless there\'s another Character in each of your Expeditions.  When I leave the Expedition zone — Create an <ORDIS_RECRUIT> Soldier token in each of your Expeditions.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
