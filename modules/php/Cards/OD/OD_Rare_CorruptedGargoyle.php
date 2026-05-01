<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_CorruptedGargoyle extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_107_R1',
            'asset'  => 'ALT_EOLE_B_OR_107_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Corrupted Gargoyle"),
      'typeline' => clienttranslate("Character - Corruption Elemental"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION,ELEMENTAL],
 				'effectDesc' => clienttranslate('#I can\'t be played# unless there\'s another Character in each of your Expeditions.  #{J}# Target Expedition <ASCENDS>.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['ocean'], 
];
  }
}
