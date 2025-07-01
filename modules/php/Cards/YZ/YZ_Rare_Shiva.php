<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_Shiva extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_YZ_74_R1',
            'asset'  => 'ALT_CYCLONE_B_YZ_74_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Shiva"),
      'typeline' => clienttranslate("Character - Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Any creation begins with an act of destruction.'),
      'artist' => "Taras Susak",
			'extension'=>'SO',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('{H} You may discard target Permanent. If you don\'t, I gain 2 boosts.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 3, 
     'costReserve' => 1, 
     'changedStats' => ['forest','mountain','ocean','costHand','costReserve'], 
];
  }
}
