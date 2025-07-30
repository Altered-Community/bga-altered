<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_Caladrius extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_YZ_72_C',
            'asset'  => 'ALT_CYCLONE_B_YZ_72_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Caladrius"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('With a simple glance, it reveals your destination.'),
      'artist' => "Fahmi  Fauzi",
			'extension'=>'SO',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} You may send to Reserve target Character with Hand Cost {2} or less.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 1, 
];
  }
}
