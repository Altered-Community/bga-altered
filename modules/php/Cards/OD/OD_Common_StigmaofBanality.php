<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_StigmaofBanality extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_116_C',
            'asset'  => 'ALT_EOLE_B_OR_116_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Stigma of Banality"),
      'typeline' => clienttranslate("Character - Corruption"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Nestor Papatriantafyllou",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION],
 				'effectDesc' => clienttranslate('{H} You may discard target Character with Base Cost {2} or less. If you do, create an <ORDIS_RECRUIT> Soldier token in its Expedition. (Its Base Cost is the Reserve Cost if Fleeting, or the Hand Cost if not.)'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 5, 
     'costReserve' => 3, 
];
  }
}
