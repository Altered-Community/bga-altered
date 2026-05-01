<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_QorganOccultist extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_106_C',
            'asset'  => 'ALT_EOLE_B_YZ_106_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Qorgan Occultist"),
      'typeline' => clienttranslate("Character - Mage"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Gamon Studio",
			'extension'=>'ROC',
   'subtypes'  => [MAGE],
 				'effectDesc' => clienttranslate('{H} I gain <FLEETING> unless you discarded a card from your hand this turn. (Not this Day.)'),
     'forest' => 2, 
     'mountain' => 0, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
