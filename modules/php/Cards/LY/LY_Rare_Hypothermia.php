<?php
namespace ALT\Cards\LY;

class LY_Rare_Hypothermia extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_40_R2',
            'asset'  => 'ALT_ALIZE_B_OR_40_R2',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Hypothermia"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('Fall asleep in the cold, and you might never wake up.'),
            'artist' => "Justice Wong",
			'extension'=>'TBF',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('Each player chooses a Character they control. It gains <ASLEEP>. (You choose first. Ignore the statistics of Asleep Characters during Dusk. At Rest, they don\'t go to Reserve and lose Asleep.)'),
     'costHand' => 1, 
     'costReserve' => 2, 
     'changedStats' => ['costReserve'], 
];
  }
}
