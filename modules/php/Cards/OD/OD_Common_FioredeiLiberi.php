<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_FioredeiLiberi extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_56_C',
            'asset'  => 'ALT_BISE_B_OR_56_C',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Fiore dei Liberi"),
            'typeline' => clienttranslate("Character - Soldier Noble"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('"I am the sword, deadly against all weapons!" — Fiore'),
            'artist' => "Jean-Baptiste Andrier",
			'extension'=>'WFTM',
   'subtypes'  => [SOLDIER,NOBLE],
 				'effectDesc' => clienttranslate('If I\'m <BOOSTED>, I\'m $<ETERNAL>.  {J} I gain 1 boost per other Character in my Expedition, then send them all to Reserve.  At Night — I lose 1 boost.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
