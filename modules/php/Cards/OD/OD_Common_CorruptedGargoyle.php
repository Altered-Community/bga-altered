<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_CorruptedGargoyle extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_107_C',
            'asset'  => 'ALT_EOLE_B_OR_107_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Corrupted Gargoyle"),
      'typeline' => clienttranslate("Character - Corruption Elemental"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION,ELEMENTAL],
 				'effectDesc' => clienttranslate('{H} I gain <FLEETING> unless there\'s another Character in each of your Expeditions.  {H} Target Expedition <ASCENDS>.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
