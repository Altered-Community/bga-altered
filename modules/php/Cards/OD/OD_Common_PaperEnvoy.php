<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_PaperEnvoy extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_108_C',
            'asset'  => 'ALT_EOLE_B_OR_108_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Paper Envoy"),
      'typeline' => clienttranslate("Character - Messenger"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Victor Canton",
			'extension'=>'ROC',
   'subtypes'  => [MESSENGER],
 				'effectDesc' => clienttranslate('{H} I gain <FLEETING> unless my Expedition is <ASCENDED_S>.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
