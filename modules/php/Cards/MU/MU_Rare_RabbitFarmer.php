<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_RabbitFarmer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_MU_86_R1',
            'asset'  => 'ALT_DUSTER_B_MU_86_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Rabbit Farmer"),
      'typeline' => clienttranslate("Character - Animal Druid"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('The pleasure of giving, the joy of receiving.'),
      'artist' => "Ba Vo",
			'extension'=>'SDU',
   'subtypes'  => [ANIMAL,DRUID],
 				'effectDesc' => clienttranslate('When you make a <GIFT> — If I have no boosts, I gain 1 boost.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 0, 
     'costHand' => 1, 
     'costReserve' => 1, 
     'changedStats' => ['forest','mountain','ocean','costHand','costReserve'], 
];
  }
}
