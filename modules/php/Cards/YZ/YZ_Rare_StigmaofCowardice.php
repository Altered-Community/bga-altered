<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_StigmaofCowardice extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_114_R2',
            'asset'  => 'ALT_EOLE_B_BR_114_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Stigma of Cowardice"),
      'typeline' => clienttranslate("Character - Corruption"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Khoa Viet",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION],
 				'effectDesc' => clienttranslate('#<TOUGH_1>.#  {J} Pass.  When an opponent passes — You may play a #card.# (Paying its cost normally.)'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 4, 
     'costReserve' => 4, 
     'changedStats' => ['forest','mountain','ocean','costHand','costReserve'], 
 		'tough'=>1,
];
  }
}
