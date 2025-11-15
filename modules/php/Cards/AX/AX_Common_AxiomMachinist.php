<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_AxiomMachinist extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_87_C',
            'asset'  => 'ALT_DUSTER_B_AX_87_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Axiom Machinist"),
      'typeline' => clienttranslate("Character - Engineer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('From Kelon to Sap to Manaseed, the Axiom never stop experimenting with alternative energy sources.'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SDU',
   'subtypes'  => [ENGINEER],
 				'effectDesc' => clienttranslate('{H} You may ready target Permanent in play or target card in Reserve.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 1, 
];
  }
}
