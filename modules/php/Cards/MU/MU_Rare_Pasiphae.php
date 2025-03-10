<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_Pasiphae extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_52_R2',
            'asset'  => 'ALT_BISE_B_YZ_52_R',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Pasiphaë"),
            'typeline' => clienttranslate("Character - Noble"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('She won\'t let herself be bullied.'),
            'artist' => "Zael",
			'extension'=>'WFTM',
   'subtypes'  => [NOBLE],
 				'effectDesc' => clienttranslate('{J} I gain 1 boost per Character target opponent controls.'),
     'forest' => 0, 
     'mountain' => 0, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
