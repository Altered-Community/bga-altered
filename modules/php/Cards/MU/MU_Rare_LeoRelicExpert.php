<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_LeoRelicExpert extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_52_R2',
            'asset'  => 'ALT_BISE_B_OR_52_R',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Leo, Relic Expert"),
            'typeline' => clienttranslate("Character - Bureaucrat Scholar"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Certain ancient knowledge must not be allowed to fall into the wrong hands.'),
            'artist' => "Fahmi Fauzi",
			'extension'=>'WFTM',
   'subtypes'  => [BUREAUCRAT,SCHOLAR],
 				'effectDesc' => clienttranslate('At Night — You may spend 1 counter from a card in your Reserve or Landmarks to <SABOTAGE_INF> after Rest.'),
     'forest' => 3, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
