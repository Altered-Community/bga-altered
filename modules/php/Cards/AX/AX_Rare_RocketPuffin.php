<?php
namespace ALT\Cards\AX;

class AX_Rare_RocketPuffin extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_33_R1',
            'asset'  => 'ALT_ALIZE_B_AX_33_R',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Rocket Puffin"),
            'typeline' => clienttranslate("Character - Animal"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Blasting off at the speed of light!'),
            'artist' => "Anh Tung",
			'extension'=>'TBF',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{J} You may ready an exhausted card in Reserve. #If you do, I gain 1 boost.#'),
     'forest' => 2, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
