<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_CorruptedEsmeralda extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_107_C',
            'asset'  => 'ALT_EOLE_B_LY_107_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Corrupted Esmeralda"),
      'typeline' => clienttranslate("Character - Artist Corruption"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Gamon Studio",
			'extension'=>'ROC',
   'subtypes'  => [ARTIST,CORRUPTION],
 				'effectDesc' => clienttranslate('{H} I gain <FLEETING> unless a {D} ability was activated this turn.  {H} <RESUPPLY>.'),
     'forest' => 0, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
