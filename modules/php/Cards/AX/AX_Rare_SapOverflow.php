<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_SapOverflow extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_59_R1',
            'asset'  => 'ALT_BISE_B_AX_59_R',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Sap Overflow"),
            'typeline' => clienttranslate("Spell - Disruption"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('With every dig, the Sap becomes riskier to harvest.'),
            'artist' => "HuoMiao Studio",
			'extension'=>'WFTM',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  #Choose one:  • Spend 1 counter from a card you control or in your Reserve to discard target Permanent.#  • Discard target Character in play or in Reserve.'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
