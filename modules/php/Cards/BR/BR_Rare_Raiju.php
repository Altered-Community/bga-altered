<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_Raiju extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_106_R1',
            'asset'  => 'ALT_EOLE_B_BR_106_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Raijū"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('It moves and strikes like lightning.'),
      'artist' => "Jamin Amaral Fernandez",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} I gain <FLEETING>.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 1, 
     'changedStats' => ['mountain'], 
     'effectHand' => FT::GAIN(ME, FLEETING),
];
  }
}
