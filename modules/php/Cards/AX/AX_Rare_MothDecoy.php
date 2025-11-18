<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_MothDecoy extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_YZ_100_R2',
            'asset'  => 'ALT_DUSTER_B_YZ_100_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Moth Decoy"),
      'typeline' => clienttranslate("Spell - Conjuration"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('"You\'re not the only ones who can use substitution." — Moyo'),
      'artist' => "Fahmi Fauzi",
			'extension'=>'SDU',
   'subtypes'  => [CONJURATION],
 				'effectDesc' => clienttranslate('You may exhaust ({T}) a card from your Reserve to play me for {1} less.  Create a <MANA_MOTH> Illusion token in target Expedition.'),
     'costHand' => 3, 
     'costReserve' => 2, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
