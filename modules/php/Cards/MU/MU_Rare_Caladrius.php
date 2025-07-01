<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_Caladrius extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_YZ_72_R2',
            'asset'  => 'ALT_CYCLONE_B_YZ_72_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Caladrius"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('With a simple glance, it reveals your destination.'),
      'artist' => "Fahmi  Fauzi",
			'extension'=>'SO',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} You may send to Reserve target Character with #Hand Cost {1}# or less.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 1, 
     'changedStats' => ['costHand'], 
];
  }
}
