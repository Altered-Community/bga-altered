<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_SouvenirSeller extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_87_R2',
            'asset'  => 'ALT_DUSTER_B_OR_87_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Souvenir Seller"),
      'typeline' => clienttranslate("Character - Merchant"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Souvenirs are memories incarnate. Treasure them."'),
      'artist' => "Zero Wen",
			'extension'=>'SDU',
   'subtypes'  => [MERCHANT],
 				'effectDesc' => clienttranslate('{J} You may give me 1 boost. If you do, target opponent <RESUPPLIES>. (They put the top card of their deck in Reserve.)'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
