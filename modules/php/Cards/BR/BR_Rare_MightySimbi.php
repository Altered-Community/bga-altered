<?php
namespace ALT\Cards\BR;

class BR_Rare_MightySimbi extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_37_R2',
            'asset'  => 'ALT_ALIZE_B_MU_37_R2',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Mighty Simbi"),
            'typeline' => clienttranslate("Character - Plant Elemental"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('A single seed can start a forest.'),
            'artist' => "Gael Giudicelli",
			'extension'=>'TBF',
   'subtypes'  => [PLANT,ELEMENTAL],
 				'effectDesc' => clienttranslate('When my Expedition moves forward due to {V} — You may #put me in my owner\'s Mana zone# (as an exhausted Mana Orb).'),
     'forest' => 3, 
     'mountain' => 0, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 3, 
     'changedStats' => ['forest'], 
];
  }
}
