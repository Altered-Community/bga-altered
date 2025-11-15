<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_Pinocchio extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_86_C',
            'asset'  => 'ALT_DUSTER_B_LY_86_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Pinocchio"),
      'typeline' => clienttranslate("Character - Robot"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('After that, he\'ll sleep like a log, and that\'s no lie.'),
      'artist' => "Victor Canton",
			'extension'=>'SDU',
   'subtypes'  => [ROBOT],
     'forest' => 0, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 1, 
];
  }
}
