<?php
namespace ALT\Cards\MU;

class MU_Rare_Sow extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_41_R1',
            'asset'  => 'ALT_ALIZE_B_MU_41_R',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Sow"),
            'typeline' => clienttranslate("Spell - Boon"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('The wise gardener prepares ahead of spring.'),
            'artist' => "Romain Kurdi",
			'extension'=>'TBF',
   'subtypes'  => [BOON],
 				'effectDesc' => clienttranslate('$<COOLDOWN>.  Target Character gains 1 boost.'),
 				'supportDesc' => clienttranslate('{D} : #Target Character with Hand Cost {3} or less gains <ANCHORED>.# (Discard me from Reserve to do this.)'),
 			     'supportIcon' => 'discard',
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
