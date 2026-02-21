<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_StigmaofBanality extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_116_R1',
            'asset'  => 'ALT_EOLE_B_OR_116_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Stigma of Banality"),
      'typeline' => clienttranslate("Character - Corruption"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Nestor Papatriantafyllou",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION],
 				'effectDesc' => clienttranslate('{H} You may discard target Character with Base Cost #{1} or less.# If you do, create an <ORDIS_RECRUIT> Soldier token in its Expedition.'),
     'forest' => 4, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 4, 
     'costReserve' => 3, 
     'changedStats' => ['forest','costHand'], 
];
  }
}
