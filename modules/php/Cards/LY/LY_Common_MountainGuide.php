<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_MountainGuide extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_66_C',
            'asset'  => 'ALT_CYCLONE_B_LY_66_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Mountain Guide"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Who better than a groundhog to wind their way through these hanging rice fields?'),
      'artist' => "Ba Vo",
			'extension'=>'SO',
   'subtypes'  => [ANIMAL],
     'forest' => 0, 
     'mountain' => 2, 
     'ocean' => 0, 
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
