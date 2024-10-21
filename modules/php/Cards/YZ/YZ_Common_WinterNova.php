<?php
namespace ALT\Cards\YZ;

class YZ_Common_WinterNova extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_37_C',
            'asset'  => 'ALT_ALIZE_B_YZ_37_C',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Winter Nova"),
            'typeline' => clienttranslate("Spell - Disruption Maneuver"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('A forgotten power waits to be awakened.'),
            'artist' => "Edward Chee & Seok Yeong",
			'extension'=>'TBF',
   'subtypes'  => [DISRUPTION,MANEUVER],
 				'effectDesc' => clienttranslate('<FLEETING>.  Choose three:  • Exhaust up to two cards in Reserve.  • Create two <MANA_MOTH> Illusion tokens in target Expedition.  • Discard target Permanent.  • Target player sacrifices a Character.'),
     'costHand' => 8, 
     'costReserve' => 8, 
];
  }
}
