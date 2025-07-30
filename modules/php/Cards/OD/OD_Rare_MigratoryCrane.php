<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_MigratoryCrane extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_MU_71_R2',
            'asset'  => 'ALT_CYCLONE_B_MU_71_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Migratory Crane"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('When the cranes start their migration, that\'s the signal that it\'s time to seek out new horizons.'),
      'artist' => "Zael",
			'extension'=>'SO',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('When a Character joins the Expedition facing me — You may have me switch Expeditions.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['mountain','ocean'], 
];
  }
}
