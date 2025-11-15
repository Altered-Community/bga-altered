<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_SunisaOrdisBodyguard extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_93_C',
            'asset'  => 'ALT_DUSTER_B_OR_93_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Sunisa, Ordis Bodyguard"),
      'typeline' => clienttranslate("Character - Soldier"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Behind the smiles and jubilation, I sense a growing tension…"'),
      'artist' => "Tristan Bideau",
			'extension'=>'SDU',
   'subtypes'  => [SOLDIER],
 				'effectDesc' => clienttranslate('$<DEFENDER_FS>.  If there are two or more cards in your Landmarks, <DEFENDER_CHA_P> Characters don\'t prevent my Expedition from moving forward.'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
