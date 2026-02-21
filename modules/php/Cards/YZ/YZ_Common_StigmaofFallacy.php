<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_StigmaofFallacy extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_115_C',
            'asset'  => 'ALT_EOLE_B_YZ_115_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Stigma of Fallacy"),
      'typeline' => clienttranslate("Character - Corruption"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Ba Vo",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION],
 				'effectDesc' => clienttranslate('{H} If there\'s a \"Stigma of Fallacy\" in your discard pile, create a <MANA_MOTH> Illusion token in target Expedition.'),
 				'supportDesc' => clienttranslate('{D} : <AFTER_YOU>. (End your turn as if you had played a card.)'),
 			     'supportIcon' => 'discard',
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
