<?php
namespace ALT\Cards\MU;

class MU_Rare_FlawedPrototype extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_38_R2',
            'asset'  => 'ALT_ALIZE_B_AX_38_R2',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Flawed Prototype"),
            'typeline' => clienttranslate("Character - Robot"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('"If we could just find a substitute for the missing parts, we could make it work."'),
            'artist' => "Zael",
			'extension'=>'TBF',
   'subtypes'  => [ROBOT],
 				'effectDesc' => clienttranslate('{J} Sacrifice a #Plant# or Permanent. If you can\'t, sacrifice me.'),
     'forest' => 5, 
     'mountain' => 5, 
     'ocean' => 5, 
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
