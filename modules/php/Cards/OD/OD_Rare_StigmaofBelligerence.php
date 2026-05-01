<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_StigmaofBelligerence extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_MU_117_R2',
            'asset'  => 'ALT_EOLE_B_MU_117_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Stigma of Belligerence"),
      'typeline' => clienttranslate("Character - Corruption Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zaeliven",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION,ANIMAL],
 				'effectDesc' => clienttranslate('#{J}# #Create an <ORDIS_RECRUIT> Soldier token in another Expedition.# Then, if I\'m facing one or more Characters, target one of them and we both gain <ANCHORED>.'),
     'forest' => 3, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
