<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_WigwaggingKiwi extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_111_C',
            'asset'  => 'ALT_EOLE_B_OR_111_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Wigwagging Kiwi"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zaeliven",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{J} I gain 1 boost per <ASCENDED_S> Expedition you control.'),
     'forest' => 1, 
     'mountain' => 0, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
