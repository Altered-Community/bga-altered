<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_FabLabUnit extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_99_R1',
            'asset'  => 'ALT_DUSTER_B_AX_99_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Fab Lab Unit"),
      'typeline' => clienttranslate("Expedition_permanent - Gear"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('All the power of the Foundry distilled into this miracle of technology.'),
      'artist' => "Anh Tung",
			'extension'=>'SDU',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('{T} : The next Character played from your hand in my Expedition this turn activates one of its {r} abilities, #then gains 1 boost.#'),
     'costHand' => 2, 
     'costReserve' => 1, 
];
  }
}
