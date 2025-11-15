<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_RabbitFarmer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_MU_86_C',
            'asset'  => 'ALT_DUSTER_B_MU_86_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Rabbit Farmer"),
      'typeline' => clienttranslate("Character - Animal Druid"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('The pleasure of giving, the joy of receiving.'),
      'artist' => "Ba Vo",
			'extension'=>'SDU',
   'subtypes'  => [ANIMAL,DRUID],
 				'effectDesc' => clienttranslate('When you make a <GIFT> — If I have no boosts, I gain 1 boost. (A Gift is when on your turn, an opponent draws a card, Resupplies or receives a token.)'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
