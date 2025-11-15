<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_Pinocchio extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_86_R2',
            'asset'  => 'ALT_DUSTER_B_LY_86_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Pinocchio"),
      'typeline' => clienttranslate("Character - Robot"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('After that, he\'ll sleep like a log, and that\'s no lie.'),
      'artist' => "Victor Canton",
			'extension'=>'SDU',
   'subtypes'  => [ROBOT],
 				'effectDesc' => clienttranslate('#{R} If there are three or more base statistics of 0 among Characters you control, draw a card.#'),
     'forest' => 0, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costReserve'], 
];
  }
}
