<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_Nuit extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_73_R2',
            'asset'  => 'ALT_CYCLONE_B_LY_73_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Nuit"),
      'typeline' => clienttranslate("Character - Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Gone is the sun, and again comes the night.'),
      'artist' => "Exia",
			'extension'=>'SO',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('{H} If there are #7 or more boosts# among Characters you control and in your Reserve, each player passes. (Starting with you, they end their Afternoon and don\'t take any more turns this Day.)'),
     'forest' => 0, 
     'mountain' => 0, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 1, 
     'changedStats' => ['ocean','costHand','costReserve'], 
];
  }
}
