<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_NilamSpires extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_62_R2',
            'asset'  => 'ALT_BISE_B_YZ_62_R',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Nilam Spires"),
            'typeline' => clienttranslate("Landmark_permanent - Construction"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Observing the Tumult requires taking a high-level perspective on it, and mastering it requires knowledge.'),
            'artist' => "Jean-Baptiste Andrier",
			'extension'=>'WFTM',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('When #another Permanent joins your Expeditions or Landmarks# — I gain 1 Arcane counter. Then, you may exhaust me ({T}) and #spend 3# of my Arcane counters to create a #<BRASSBUG> Robot# token in target Expedition.'),
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
