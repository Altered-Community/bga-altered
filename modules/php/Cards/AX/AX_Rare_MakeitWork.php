<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_MakeitWork extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_121_R1',
            'asset'  => 'ALT_EOLE_B_AX_121_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Make it Work"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Put a card from your hand in Reserve.  When you pass — If your hand is empty, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: {T} : If your hand is empty, <RESUPPLY_LOW>.'),
 			     'supportIcon' => 'discard',
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
