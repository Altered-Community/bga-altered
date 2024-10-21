<?php
namespace ALT\Cards\YZ;

class YZ_Rare_Belasenka extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_35_R1',
            'asset'  => 'ALT_ALIZE_B_YZ_35_R',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Belasenka"),
            'typeline' => clienttranslate("Character - Animal"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('The cold snap they ride, like a shivering tide.'),
            'artist' => "Ba Vo",
			'extension'=>'TBF',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} You may exhaust ({T}) target card in Reserve. #Then, if there are two or more exhausted card in Reserve, I gain 1 boost.#'),
     'forest' => 3, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
