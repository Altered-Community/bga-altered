<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_TerrifiedGhost extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_107_C',
            'asset'  => 'ALT_EOLE_B_YZ_107_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Terrified Ghost"),
      'typeline' => clienttranslate("Character - Spirit"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'ROC',
   'subtypes'  => [SPIRIT],
     'forest' => 2, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 1, 
];
  }
}
