<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_EruEmissaryoftheWild extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_MU_68_C',
            'asset'  => 'ALT_CYCLONE_B_MU_68_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Eru, Emissary of the Wild"),
      'typeline' => clienttranslate("Character - Druid"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Surrounded by all of his animal friends, my teacher never felt alone, even living as a hermit." - Kauri'),
      'artist' => "Nestor Papatriantafyllou",
			'extension'=>'SO',
   'subtypes'  => [DRUID],
     'forest' => 4, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
