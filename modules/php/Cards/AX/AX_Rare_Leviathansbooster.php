<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_Leviathansbooster extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_102_R2',
            'asset'  => 'ALT_DUSTER_B_BR_102_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Leviathan's booster"),
      'typeline' => clienttranslate("Expedition_permanent - Gear"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('An essential accessory for any Leviathan rider.'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SDU',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('{T}, {1} : The next Character that joins my Expedition this turn gains 2 boosts.'),
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
