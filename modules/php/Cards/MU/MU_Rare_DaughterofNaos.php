<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_DaughterofNaos extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_MU_92_R1',
            'asset'  => 'ALT_DUSTER_B_MU_92_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Daughter of Naos"),
      'typeline' => clienttranslate("Character - Plant"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('The torture of the Naos must cease.'),
      'artist' => "Khoa Viet",
			'extension'=>'SDU',
   'subtypes'  => [PLANT],
 				'effectDesc' => clienttranslate('If I\'m <ANCHORED_FS>, I\'m <DEFENDER_FS>.  {J} I gain <ANCHORED>.  #When you make a <GIFT> — If I have less than 2 boosts, I gain 1 boost.#'),
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
