<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_Shiva extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_YZ_74_C',
            'asset'  => 'ALT_CYCLONE_B_YZ_74_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Shiva"),
      'typeline' => clienttranslate("Character - Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Any creation begins with an act of destruction.'),
      'artist' => "Taras Susak",
			'extension'=>'SO',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('{H} You may discard target Permanent. If you don\'t, I gain 2 boosts.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 4, 
     'costReserve' => 2, 
];
  }
}
