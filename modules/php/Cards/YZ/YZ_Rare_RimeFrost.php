<?php
namespace ALT\Cards\YZ;

class YZ_Rare_RimeFrost extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_39_R1',
            'asset'  => 'ALT_ALIZE_B_YZ_39_R',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Rime Frost"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('A late frost delays the spring.'),
            'artist' => "HuoMiao Studio",
			'extension'=>'TBF',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('#Choose one:  • Discard target exhausted card from a Reserve.#  • Exhaust ({T}) target card in Reserve. (Exhausted cards can\'t be played and have no Support abilities.)'),
     'costHand' => 1, 
     'costReserve' => 2, 
];
  }
}
