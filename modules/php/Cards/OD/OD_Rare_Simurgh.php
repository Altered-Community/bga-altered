<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_Simurgh extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_58_R1',
            'asset'  => 'ALT_BISE_B_OR_58_R',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Simurgh"),
            'typeline' => clienttranslate("Character - Animal"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Three feathers. Each time you burn one, it will grant you its help.'),
            'artist' => "Khoa Viet",
			'extension'=>'WFTM',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('<GIGANTIC>.  {J} If you have less cards in Reserve than target opponent, draw a card.'),
 				'supportDesc' => clienttranslate('#{I} All Reserve limits are reduced by one.#'),
 			     'supportIcon' => 'infinity',
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 7, 
     'costReserve' => 7, 
 		'gigantic' => true,
];
  }
}
