<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_ManaSeamstress extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_109_C',
            'asset'  => 'ALT_EOLE_B_YZ_109_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Mana Seamstress"),
      'typeline' => clienttranslate("Character - Artist Mage"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung",
			'extension'=>'ROC',
   'subtypes'  => [ARTIST,MAGE],
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
