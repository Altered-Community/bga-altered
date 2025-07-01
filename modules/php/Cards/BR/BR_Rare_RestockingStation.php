<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_RestockingStation extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_81_R2',
            'asset'  => 'ALT_CYCLONE_B_AX_81_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Restocking Station"),
      'typeline' => clienttranslate("Landmark_permanent - Construction"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('"Kelon powers our engines, aerolith gives us access to the skies. What heights will we reach with the other two Primordiae?" - Basem'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SO',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('{J} I gain 2 Kelon counters.  {T}, Spend 1 of my Kelon counters: target Character loses <FLEETING>.'),
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
