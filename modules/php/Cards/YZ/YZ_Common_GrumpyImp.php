<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_GrumpyImp extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_111_C',
            'asset'  => 'ALT_EOLE_B_YZ_111_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Grumpy Imp"),
      'typeline' => clienttranslate("Character - Spirit"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'ROC',
   'subtypes'  => [SPIRIT],
 				'effectDesc' => clienttranslate('When you discard a card from your hand — If I have no boosts, I gain 1 boost.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
