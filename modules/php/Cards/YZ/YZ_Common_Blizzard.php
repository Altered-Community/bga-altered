<?php
namespace ALT\Cards\YZ;

class YZ_Common_Blizzard extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_42_C',
            'asset'  => 'ALT_ALIZE_B_YZ_42_C',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Blizzard"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('The icy winds wrecked the army, despite months of preparation.'),
            'artist' => "Jean-Baptiste Andirer",
			'extension'=>'TBF',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  Send to Reserve each Character from target Expedition, then exhaust them ({T}). (Exhausted cards can\'t be played and have no Support abilities.)'),
     'costHand' => 5, 
     'costReserve' => 5, 
];
  }
}
