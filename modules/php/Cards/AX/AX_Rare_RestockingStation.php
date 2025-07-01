<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_RestockingStation extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_81_R1',
            'asset'  => 'ALT_CYCLONE_B_AX_81_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Restocking Station"),
      'typeline' => clienttranslate("Landmark_permanent - Construction"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('"Kelon powers our engines, aerolith gives us access to the skies. What heights will we reach with the other two Primordiae?" - Basem'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SO',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('{J} I gain #3 Kelon counters.#  {T}, Spend #any number# of my Kelon counters: #the same number# of target Characters lose <FLEETING>.'),
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
