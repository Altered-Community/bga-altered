<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_YeonggiEmber extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_105_C',
            'asset'  => 'ALT_EOLE_B_LY_105_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Yeong-gi & Ember"),
      'typeline' => clienttranslate("Lyra Hero"),
    	'type'  => HERO,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   				'effectDesc' => clienttranslate('{T} : Target a Character you control, then roll a die. You may then spend any number of my Luck counters to increase the result by that much. On a:  • 4+: It activates its {D} ability.  • 1-3: I gain 1 Luck counter.'),
];
  }
}
