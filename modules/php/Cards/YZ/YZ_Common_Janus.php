<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_Janus extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_113_C',
            'asset'  => 'ALT_EOLE_B_YZ_113_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Janus"),
      'typeline' => clienttranslate("Character - Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Gamon Studio",
			'extension'=>'ROC',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('$<GIGANTIC>.  When you discard a card from your hand — I gain 1 boost.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 4, 
     'costReserve' => 4, 
 		'gigantic' => true,
];
  }
}
