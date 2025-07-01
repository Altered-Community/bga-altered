<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_JoiningFates extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_MU_81_R1',
            'asset'  => 'ALT_CYCLONE_B_MU_81_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Joining Fates"),
      'typeline' => clienttranslate("Spell - Conjuration"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('"Be united in the Musubi."'),
      'artist' => "Kevin Sidharta",
			'extension'=>'SO',
   'subtypes'  => [CONJURATION],
 				'effectDesc' => clienttranslate('<FLEETING>.  #Target player# may immediately play a Character #for free# in their Companion Expedition. It gains <ANCHORED>.'),
     'costHand' => 8, 
     'costReserve' => 8, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
