<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_BrassbugNursery extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_78_C',
            'asset'  => 'ALT_CYCLONE_B_AX_78_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Brassbug Nursery"),
      'typeline' => clienttranslate("Landmark_permanent - Construction"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('Even far from their Hive, the Brassbugs have developed a way to continue reproducing.'),
      'artist' => "Justice Wong",
			'extension'=>'SO',
   'subtypes'  => [CONSTRUCTION,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Create an <AEROLITH> token in your Landmarks. (It\'s a Permanent with \"When I\'m sacrificed — Resupply. {T}, {1}: Sacrifice me.\")  {T}, {1}, Sacrifice a Permanent: create a <BRASSBUG> Robot token in target Expedition.'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
