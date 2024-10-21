<?php
namespace ALT\Cards\BR;

class BR_Rare_TinyJail extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_42_R2',
            'asset'  => 'ALT_ALIZE_B_OR_42_R2',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Tiny Jail"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('Do not collect 200 Florets.'),
            'artist' => "HuoMiao Studio",
			'extension'=>'TBF',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  Send to Reserve target Character with no statistic over 3.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
