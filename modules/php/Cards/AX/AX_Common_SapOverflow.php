<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_SapOverflow extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_59_C',
            'asset'  => 'ALT_BISE_B_AX_59_C',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Sap Overflow"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('With every dig, the Sap becomes riskier to harvest.'),
            'artist' => "HuoMiao Studio",
			'extension'=>'WFTM',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('$<FLEETING>.  Discard target Character in play or in Reserve.'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
