<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_HopomyThumb extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_107_R2',
            'asset'  => 'ALT_EOLE_B_AX_107_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Hop-o'-my-Thumb"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('#{H}# You may put a card from your hand in Reserve to create an <AEROLITH> token in your Landmarks.'),
     'forest' => 2, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 1, 
     'changedStats' => ['ocean','costReserve'], 
];
  }
}
