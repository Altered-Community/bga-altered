<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Exalted_ClosetheBreach extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_122_E',
            'asset'  => 'ALT_EOLE_B_YZ_122_E',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_EXALTED,
    	'name'  => clienttranslate("Close the Breach!"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung & Ba Vo",
			'extension'=>'ROC',
   'subtypes'  => [FEAT,LANDMARK],
 				'effectDesc' => clienttranslate('{J} Discard target Character with Base Cost {3} or less.  When you pass after your opponents — If you are first player, complete me.'),
 				'supportDesc' => clienttranslate('<COMPLETED>: {T}, {1} : Target Character you control gains 1 boost, then <AFTER_YOU>.'),
 			     'supportIcon' => 'discard',
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
