<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_SneakySalamander extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_106_R2',
            'asset'  => 'ALT_EOLE_B_AX_106_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Sneaky Salamander"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Khoa Viet",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('#{J}# You may put a card from your hand in Reserve.'),
     'forest' => 1, 
     'mountain' => 2, 
     'ocean' => 0, 
     'costHand' => 1, 
     'costReserve' => 1, 
     'changedStats' => ['mountain'], 
];
  }
}
