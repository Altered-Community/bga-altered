<?php
namespace ALT\Cards\BR;

class BR_Common_Eros extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_40_C',
            'asset'  => 'ALT_ALIZE_B_BR_40_C',

    		'faction'  => FACTION_BR,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Eros"),
            'typeline' => clienttranslate("Character - Deity"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('He\'s got more than one arrow in his quiver.'),
            'artist' => "Justice Wong",
			'extension'=>'TBF',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('{J} You may immediately play a Character for {3} less.'),
     'forest' => 3, 
     'mountain' => 6, 
     'ocean' => 6, 
     'costHand' => 7, 
     'costReserve' => 7, 
];
  }
}
