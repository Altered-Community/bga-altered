<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_Metamorphosis extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_60_C',
            'asset'  => 'ALT_BISE_B_YZ_60_C',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Metamorphosis"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('Every reality contains its share of illusions.'),
            'artist' => "Zero Wen",
			'extension'=>'WFTM',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('$<FLEETING>.  Discard target Character, then create a <MANA_MOTH> Illusion token in its Expedition.'),
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
