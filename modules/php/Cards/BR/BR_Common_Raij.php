<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_Raij extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_106_C',
            'asset'  => 'ALT_EOLE_B_BR_106_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Raij?"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jamin Amaral Fernandez",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} I gain <FLEETING>. (If I would be sent to Reserve, discard me instead.)'),
     'forest' => 2, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 1, 
     'effectHand' => FT::GAIN(ME, FLEETING),
];
  }
}
