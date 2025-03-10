<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_LicenseWithdrawal extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_59_R1',
            'asset'  => 'ALT_BISE_B_OR_59_R',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("License Withdrawal"),
            'typeline' => clienttranslate("Spell - Disruption Maneuver"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('"Enough of this mess!"'),
            'artist' => "Justice Wong",
			'extension'=>'WFTM',
   'subtypes'  => [DISRUPTION,MANEUVER],
 				'effectDesc' => clienttranslate('<FLEETING>.  Choose one:  • Discard target <BOOSTED> Character #with Hand Cost {3} or less.#  • Discard target Permanent #with Hand Cost {3} or less.#'),
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
