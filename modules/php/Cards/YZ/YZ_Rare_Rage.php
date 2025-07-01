<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_Rage extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_BR_80_R2',
            'asset'  => 'ALT_CYCLONE_B_BR_80_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Rage"),
      'typeline' => clienttranslate("Spell - Boon Disruption"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('"If its fury does not wane, it will soon have a taste of my own!" - Sol'),
      'artist' => "Justice Wong",
			'extension'=>'SO',
   'subtypes'  => [BOON,DISRUPTION],
 				'effectDesc' => clienttranslate('Target non-Fleeting Character gains 2 boosts and <FLEETING>.'),
     'costHand' => 1, 
     'costReserve' => 2, 
];
  }
}
