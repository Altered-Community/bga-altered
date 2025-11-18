<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_RabbitFarmer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_MU_86_R2',
            'asset'  => 'ALT_DUSTER_B_MU_86_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Rabbit Farmer"),
      'typeline' => clienttranslate("Character - Animal Druid"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('The pleasure of giving, the joy of receiving.'),
      'artist' => "Ba Vo",
			'extension'=>'SDU',
   'subtypes'  => [ANIMAL,DRUID],
 				'effectDesc' => clienttranslate('When you make a <GIFT> — If I have no boosts, I gain 1 boost. (A Gift is when on your turn, an opponent draws a card, Resupplies or receives a token.)'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 0, 
     'costHand' => 1, 
     'costReserve' => 1, 
     'changedStats' => ['forest','mountain','ocean','costHand','costReserve'], 
];
  }
}
