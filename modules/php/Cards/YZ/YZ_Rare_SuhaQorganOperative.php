<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_SuhaQorganOperative extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_YZ_70_R1',
            'asset'  => 'ALT_CYCLONE_B_YZ_70_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Suha, Qorgan Operative"),
      'typeline' => clienttranslate("Character - Bureaucrat Mage"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('By accepting the Qorgan\'s offer, Suha got to see what was down the rabbit hole.'),
      'artist' => "Tristan Bideau",
			'extension'=>'SO',
   'subtypes'  => [BUREAUCRAT,MAGE],
 				'effectDesc' => clienttranslate('{H} I gain #2 boosts.#  #When I go to Reserve from the Expedition zone — <SABOTAGE>.#'),
     'forest' => 1, 
     'mountain' => 0, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 1, 
     'changedStats' => ['mountain'], 
];
  }
}
