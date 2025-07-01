<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_Medusa extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_71_C',
            'asset'  => 'ALT_CYCLONE_B_AX_71_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Medusa"),
      'typeline' => clienttranslate("Character - Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('They made her a monster simply for defending herself.'),
      'artist' => "Nestor Papatriantafyllou",
			'extension'=>'SO',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('{R} You may discard target Character. If you do, create an <AEROLITH> token in its controller\'s Landmarks. (It\'s a Permanent with \"When I\'m sacrificed — Resupply. {T}, {1}: Sacrifice me.\")'),
     'forest' => 3, 
     'mountain' => 2, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 5, 
];
  }
}
