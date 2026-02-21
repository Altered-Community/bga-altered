<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_ShiramunTechMonk extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_111_R2',
            'asset'  => 'ALT_EOLE_B_AX_111_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Shiramun, Tech Monk"),
      'typeline' => clienttranslate("Character - Engineer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Tristan Bideau",
			'extension'=>'ROC',
   'subtypes'  => [ENGINEER],
 				'effectDesc' => clienttranslate('{H} You may #discard a card from your Reserve# to <SABOTAGE_INF>.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costHand'], 
];
  }
}
