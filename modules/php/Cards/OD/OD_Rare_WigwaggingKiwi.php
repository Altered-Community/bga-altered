<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_WigwaggingKiwi extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_111_R1',
            'asset'  => 'ALT_EOLE_B_OR_111_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Wigwagging Kiwi"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zaeliven",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{J} I gain 1 boost per <ASCENDED_S> Expedition you control.  #If one of your <ASCENDED_P> Expeditions would attempt to <ASCEND_INF> again, I also gain 1 boost.#'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['mountain','ocean'], 
];
  }
}
