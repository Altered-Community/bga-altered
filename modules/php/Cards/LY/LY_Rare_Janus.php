<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_Janus extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_113_R2',
            'asset'  => 'ALT_EOLE_B_YZ_113_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Janus"),
      'typeline' => clienttranslate("Character - Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Gamon Studio",
			'extension'=>'ROC',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('<GIGANTIC>.  When you discard a card from your hand #or your Reserve# — I gain 1 boost.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 5, 
     'costReserve' => 5, 
     'changedStats' => ['costHand','costReserve'], 
 		'gigantic' => true,
];
  }
}
