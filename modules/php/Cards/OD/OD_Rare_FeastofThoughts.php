<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_FeastofThoughts extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_61_R2',
            'asset'  => 'ALT_BISE_B_YZ_61_R',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Feast of Thoughts"),
            'typeline' => clienttranslate("Spell - Conjuration Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('When the Remanence strikes, ideas burst out of one\'s mind like water from a dam.'),
            'artist' => "HuoMiao Studio",
			'extension'=>'WFTM',
   'subtypes'  => [CONJURATION,DISRUPTION],
 				'effectDesc' => clienttranslate('Choose X+1, where X is my number of Arcane counters:  • Draw a card.  • Create a <MANA_MOTH> Illusion token in target Expedition.  • Remove 3 counters from target card in play or in Reserve.  • <SABOTAGE>.'),
 				'supportDesc' => clienttranslate('{I} When #a Character joins your Expeditions# — I gain 1 Arcane counter, up to a max of 3.'),
 			     'supportIcon' => 'infinity',
     'costHand' => 3, 
     'costReserve' => 5, 
];
  }
}
