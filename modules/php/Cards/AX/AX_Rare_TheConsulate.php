<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_TheConsulate extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_102_R2',
            'asset'  => 'ALT_DUSTER_B_OR_102_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("The Consulate"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('Here, far from the crowd, is where fruitful negotiations are held between Reka and Asgarthans.'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SDU',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('{J} #<RESUPPLY>.#  {T} : Target an Expedition, then create one <ORDIS_RECRUIT> Soldier token in it #per card in your Landmarks, up to three per activation.#'),
     'costHand' => 5, 
     'costReserve' => 5, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
