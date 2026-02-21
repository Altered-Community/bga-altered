<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_TerrifiedGhost extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_107_R1',
            'asset'  => 'ALT_EOLE_B_YZ_107_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Terrified Ghost"),
      'typeline' => clienttranslate("Character - Spirit"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'ROC',
   'subtypes'  => [SPIRIT],
 				'effectDesc' => clienttranslate('#When I\'m discarded from your hand — <RESUPPLY>.#'),
     'forest' => 2, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 1, 
];
  }
}
