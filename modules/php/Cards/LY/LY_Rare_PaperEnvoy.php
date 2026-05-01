<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_PaperEnvoy extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_108_R2',
            'asset'  => 'ALT_EOLE_B_OR_108_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Paper Envoy"),
      'typeline' => clienttranslate("Character - Messenger"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Victor Canton",
			'extension'=>'ROC',
   'subtypes'  => [MESSENGER],
 				'effectDesc' => clienttranslate('{H} I gain <FLEETING> unless #a {D} ability was activated this turn.#'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 2, 
     'costHand' => 1, 
     'costReserve' => 1, 
     'changedStats' => ['ocean'], 
];
  }
}
