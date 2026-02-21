<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_StigmaofFallacy extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_115_R1',
            'asset'  => 'ALT_EOLE_B_YZ_115_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Stigma of Fallacy"),
      'typeline' => clienttranslate("Character - Corruption"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Ba Vo",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION],
 				'effectDesc' => clienttranslate('#{J}# Do this once #for each# \"Stigma of Fallacy\" in your discard pile:  • Create a <MANA_MOTH> Illusion token in target Expedition.'),
 				'supportDesc' => clienttranslate('{D} : <AFTER_YOU>.'),
 			     'supportIcon' => 'discard',
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
