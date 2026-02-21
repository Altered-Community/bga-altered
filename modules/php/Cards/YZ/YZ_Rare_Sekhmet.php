<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_Sekhmet extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_113_R2',
            'asset'  => 'ALT_EOLE_B_BR_113_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Sekhmet"),
      'typeline' => clienttranslate("Character - Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
			'extension'=>'ROC',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('{H} You may return target Character facing me with Base Cost #{2} or less# to its owner\'s hand.  {R} I gain 2 boosts.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 4, 
     'changedStats' => ['costHand'], 
];
  }
}
