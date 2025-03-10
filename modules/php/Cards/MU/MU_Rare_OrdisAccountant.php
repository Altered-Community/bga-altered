<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_OrdisAccountant extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_50_R2',
            'asset'  => 'ALT_BISE_B_OR_50_R',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Ordis Accountant"),
            'typeline' => clienttranslate("Character - Bureaucrat"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('He has an annoying tendency to overwhelm you with numbers.'),
            'artist' => "Matteo Spirito",
			'extension'=>'WFTM',
   'subtypes'  => [BUREAUCRAT],
 				'effectDesc' => clienttranslate('{R} You may spend 1 of my boosts to have target Character gain <ASLEEP>. #You may give it 2 boosts.#'),
 				'supportDesc' => clienttranslate('{I} #At Noon# — I gain 1 boost, up to a max of 2.'),
 			     'supportIcon' => 'infinity',
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 3, 
];
  }
}
