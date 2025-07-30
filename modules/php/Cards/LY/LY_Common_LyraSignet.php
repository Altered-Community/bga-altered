<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_LyraSignet extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_78_C',
            'asset'  => 'ALT_CYCLONE_B_LY_78_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Lyra Signet"),
      'typeline' => clienttranslate("Spell - Conjuration"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('Creation and transformation.'),
      'artist' => "Ed Chee, S.yong & Stephen",
			'extension'=>'SO',
   'subtypes'  => [CONJURATION],
 				'effectDesc' => clienttranslate('Choose one:  • Up to two target Characters gain <FLEETING>.  • Draw a card, then roll a die. On a 4+, <RESUPPLY_LOW>.  • Target Character gains 1 boost per card in your Reserve.'),
     'costHand' => 2, 
     'costReserve' => 4, 
];
  }
}
