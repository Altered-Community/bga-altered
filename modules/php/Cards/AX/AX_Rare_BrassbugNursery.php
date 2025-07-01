<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_BrassbugNursery extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_78_R1',
            'asset'  => 'ALT_CYCLONE_B_AX_78_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Brassbug Nursery"),
      'typeline' => clienttranslate("Landmark_permanent - Construction"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('Even far from their Hive, the Brassbugs have developed a way to continue reproducing.'),
      'artist' => "Justice Wong",
			'extension'=>'SO',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('{T}, {1}, Sacrifice a Permanent: create a <BRASSBUG> Robot token in target Expedition.'),
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
