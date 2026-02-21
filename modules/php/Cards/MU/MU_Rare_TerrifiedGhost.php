<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_TerrifiedGhost extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_107_R2',
            'asset'  => 'ALT_EOLE_B_YZ_107_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Terrified Ghost"),
      'typeline' => clienttranslate("Character - Spirit"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'ROC',
   'subtypes'  => [SPIRIT],
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 1, 
     'changedStats' => ['mountain','ocean'], 
];
  }
}
