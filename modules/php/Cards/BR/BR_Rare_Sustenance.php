<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_Sustenance extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_61_R2',
            'asset'  => 'ALT_BISE_B_MU_61_R',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Sustenance"),
            'typeline' => clienttranslate("Spell - Conjuration"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('Anything goes when there are empty bellies to be filled.'),
            'artist' => "Nestor Papatriantafyllou",
			'extension'=>'WFTM',
   'subtypes'  => [CONJURATION],
 				'effectDesc' => clienttranslate('<FLEETING>.  Draw a card.  Each player puts the top card of their deck in their Mana zone (as an exhausted Mana Orb).'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
