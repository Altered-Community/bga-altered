<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_SagittaSoaringLeviathan extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_74_R2',
            'asset'  => 'ALT_CYCLONE_B_OR_74_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Sagitta, Soaring Leviathan"),
      'typeline' => clienttranslate("Character - Leviathan"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('We flew higher to escape the turbulence of its wings.'),
      'artist' => "Ba Vo",
			'extension'=>'SO',
   'subtypes'  => [LEVIATHAN],
 				'effectDesc' => clienttranslate('I cost #{2} less# if there\'s #a Spell with Reserve Cost {4} or more in your Reserve.#  $<GIGANTIC>.'),
     'forest' => 3, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 6, 
     'costReserve' => 6, 
 		'gigantic' => true,
];
  }
}
