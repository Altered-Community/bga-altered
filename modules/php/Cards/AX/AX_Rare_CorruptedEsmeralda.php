<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_CorruptedEsmeralda extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_107_R2',
            'asset'  => 'ALT_EOLE_B_LY_107_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Corrupted Esmeralda"),
      'typeline' => clienttranslate("Character - Artist Corruption"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Gamon Studio",
			'extension'=>'ROC',
   'subtypes'  => [ARTIST,CORRUPTION],
 				'effectDesc' => clienttranslate('#I can\'t be played# unless a {D} ability was activated this turn.  #{J}# <RESUPPLY>.'),
 				'supportDesc' => clienttranslate('#{D} : Pay {1} less for the next Character you play this turn, down to a minimum of {1}.#'),
 			     'supportIcon' => 'discard',
     'forest' => 0, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
