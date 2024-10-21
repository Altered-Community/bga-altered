<?php
namespace ALT\Cards\AX;

class AX_Common_FrozenDelivery extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_41_C',
            'asset'  => 'ALT_ALIZE_B_AX_41_C',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Frozen Delivery"),
            'typeline' => clienttranslate("Spell - Conjuration"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('Precious supplies. If only the lid wasn\'t frozen shut...'),
            'artist' => "Romain Kurdi",
			'extension'=>'TBF',
   'subtypes'  => [CONJURATION],
 				'effectDesc' => clienttranslate('<COOLDOWN>. (If I go to Reserve after my effect resolves, exhaust me {T}. Exhausted cards can\'t be played and have no Support abilities.)  $<RESUPPLY>.'),
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
