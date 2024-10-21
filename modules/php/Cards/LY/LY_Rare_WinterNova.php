<?php
namespace ALT\Cards\LY;

class LY_Rare_WinterNova extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_37_R2',
            'asset'  => 'ALT_ALIZE_B_YZ_37_R2',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Winter Nova"),
            'typeline' => clienttranslate("Spell - Disruption Maneuver"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('A forgotten power waits to be awakened.'),
            'artist' => "Edward Chee & Seok Yeong",
			'extension'=>'TBF',
   'subtypes'  => [DISRUPTION,MANEUVER],
 				'effectDesc' => clienttranslate('<FLEETING>.  Choose three. #You may pick the same option multiple times:#  • Exhaust up to two cards in Reserve.  • Create two <MANA_MOTH> Illusion tokens in target Expedition.  • Discard target Permanent.  • Target player sacrifices a Character.'),
     'costHand' => 8, 
     'costReserve' => 8, 
];
  }
}
