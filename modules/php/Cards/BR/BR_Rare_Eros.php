<?php
namespace ALT\Cards\BR;

class BR_Rare_Eros extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_40_R1',
            'asset'  => 'ALT_ALIZE_B_BR_40_R',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Eros"),
            'typeline' => clienttranslate("Character - Deity"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('He\'s got more than one arrow in his quiver.'),
            'artist' => "Justice Wong",
			'extension'=>'TBF',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('{J} You may immediately play a Character for {3} less. #It gains 2 boosts.#'),
     'forest' => 3, 
     'mountain' => 5, 
     'ocean' => 5, 
     'costHand' => 7, 
     'costReserve' => 7, 
     'changedStats' => ['mountain','ocean'], 
];
  }
}
