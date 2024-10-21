<?php
namespace ALT\Cards\YZ;

class YZ_Rare_Blizzard extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_42_R1',
            'asset'  => 'ALT_ALIZE_B_YZ_42_R',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Blizzard"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('The icy winds wrecked the army, despite months of preparation.'),
            'artist' => "Jean-Baptiste Andirer",
			'extension'=>'TBF',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  #I cost {1} less if there are two or more exhausted cards in Reserve.#  Send to Reserve each Character from target Expedition, then exhaust them ({T}).'),
     'costHand' => 5, 
     'costReserve' => 5, 
];
  }
}
