<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_ShortageSupervisor extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_55_R2',
            'asset'  => 'ALT_BISE_B_AX_55_R',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Shortage Supervisor"),
            'typeline' => clienttranslate("Character - Engineer"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('With the appropriate tech, Sap can exhibit energetic properties sufficient to replace Kelon.'),
            'artist' => "Anh Tung",
			'extension'=>'WFTM',
   'subtypes'  => [ENGINEER],
 				'effectDesc' => clienttranslate('{R} If your hand is empty, #I gain 2 boosts, otherwise I gain 1 boost.#'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 2, 
     'changedStats' => ['mountain'], 
];
  }
}
