<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_QorganOccultist extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_106_R2',
            'asset'  => 'ALT_EOLE_B_YZ_106_R',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Qorgan Occultist"),
      'typeline' => clienttranslate("Character - Mage"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Gamon Studio",
			'extension'=>'ROC',
   'subtypes'  => [MAGE],
 				'effectDesc' => clienttranslate('{H} I gain <FLEETING> unless you discarded a card from your hand #or your Reserve# this turn.'),
     'forest' => 2, 
     'mountain' => 0, 
     'ocean' => 2, 
     'costHand' => 1, 
     'costReserve' => 1, 
     'changedStats' => ['ocean'], 
];
  }
}
