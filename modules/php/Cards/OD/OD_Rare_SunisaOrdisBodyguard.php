<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_SunisaOrdisBodyguard extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_93_R1',
            'asset'  => 'ALT_DUSTER_B_OR_93_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Sunisa, Ordis Bodyguard"),
      'typeline' => clienttranslate("Character - Soldier"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Behind the smiles and jubilation, I sense a growing tension…"'),
      'artist' => "Tristan Bideau",
			'extension'=>'SDU',
   'subtypes'  => [SOLDIER],
 				'effectDesc' => clienttranslate('<DEFENDER_FS>.  If there are two or more cards in your Landmarks, <DEFENDER_CHA_P> Characters don\'t prevent my Expedition from moving forward.  #{J} Create an <ORDIS_RECRUIT> Soldier token in target Expedition.#'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['forest','mountain','ocean'], 
];
  }
}
