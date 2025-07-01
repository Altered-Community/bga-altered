<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_FarFetch20 extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_69_R2',
            'asset'  => 'ALT_CYCLONE_B_AX_69_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("FarFetch 2.0"),
      'typeline' => clienttranslate("Character - Robot"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"I\'m glad I got my hooks into this new version!" - Paju'),
      'artist' => "Zael",
			'extension'=>'SO',
   'subtypes'  => [ROBOT],
 				'effectDesc' => clienttranslate('{J} You may sacrifice a #Character# or Permanent. If you do, target Character switches Expeditions.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['mountain','ocean','costHand','costReserve'], 
];
  }
}
