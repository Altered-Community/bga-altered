<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_SouvenirSeller extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_87_R1',
            'asset'  => 'ALT_DUSTER_B_OR_87_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Souvenir Seller"),
      'typeline' => clienttranslate("Character - Merchant"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Souvenirs are memories incarnate. Treasure them."'),
      'artist' => "Zero Wen",
			'extension'=>'SDU',
   'subtypes'  => [MERCHANT],
 				'effectDesc' => clienttranslate('{J} You may #create a <MANASEED> token in your Landmarks.# If you do, target opponent <RESUPPLIES>.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['forest','mountain','ocean','costHand','costReserve'], 
];
  }
}
