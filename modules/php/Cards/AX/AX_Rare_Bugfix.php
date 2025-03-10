<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_Bugfix extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_58_R1',
            'asset'  => 'ALT_BISE_B_AX_58_R',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Bugfix"),
            'typeline' => clienttranslate("Spell - Maneuver"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('It\'s not Kelon, but this Sap will make you feel better, I swear.'),
            'artist' => "Kevin Sidharta",
			'extension'=>'WFTM',
   'subtypes'  => [MANEUVER],
 				'effectDesc' => clienttranslate('<COOLDOWN>.  You may spend 1 counter from a card you control or in your Reserve to create a <BRASSBUG> Robot token in target Expedition.'),
     'costHand' => 1, 
     'costReserve' => 1, 
     'changedStats' => ['costReserve'], 
 		'cooldown' => true,
];
  }
}
