<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_GrumpyImp extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_111_R2',
            'asset'  => 'ALT_EOLE_B_YZ_111_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Grumpy Imp"),
      'typeline' => clienttranslate("Character - Spirit"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'ROC',
   'subtypes'  => [SPIRIT],
 				'effectDesc' => clienttranslate('When you #put a card from your hand in Reserve# — If I have no boosts, I gain 1 boost.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
