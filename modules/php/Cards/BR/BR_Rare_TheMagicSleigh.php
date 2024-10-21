<?php
namespace ALT\Cards\BR;

class BR_Rare_TheMagicSleigh extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_44_R2',
            'asset'  => 'ALT_ALIZE_B_LY_44_R2',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("The Magic Sleigh"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
    		'type'  => PERMANENT,
    		'flavorText'  => clienttranslate('Here to sleigh!'),
            'artist' => "Khoa Viet",
			'extension'=>'TBF',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('#{J} I gain <FLEETING_CHAR>.#  If my Expedition would move forward during Dusk, it moves twice instead.'),
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
