<?php
namespace ALT\Cards\BR;

class BR_Rare_ManaFlare extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_41_R1',
            'asset'  => 'ALT_ALIZE_B_BR_41_R',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Mana Flare"),
            'typeline' => clienttranslate("Spell - Conjuration"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('He summons the mightiest beings just for the sake of an epic duel.'),
            'artist' => "Justice Wong",
			'extension'=>'TBF',
   'subtypes'  => [CONJURATION],
 				'effectDesc' => clienttranslate('$<FLEETING>.  Immediately play a Character for {5} less.'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
