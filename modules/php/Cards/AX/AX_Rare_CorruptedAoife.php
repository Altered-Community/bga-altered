<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_CorruptedAoife extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_108_R2',
            'asset'  => 'ALT_EOLE_B_BR_108_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Corrupted Aoife"),
      'typeline' => clienttranslate("Character - Adventurer Corruption"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Gamon Studio",
			'extension'=>'ROC',
   'subtypes'  => [ADVENTURER,CORRUPTION],
 				'effectDesc' => clienttranslate('#I can\'t be played# unless you control a Feat.  {R} You may target another Character. It loses <FLEETING> and gains 1 boost.'),
     'forest' => 3, 
     'mountain' => 0, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costReserve'], 
];
  }
}
