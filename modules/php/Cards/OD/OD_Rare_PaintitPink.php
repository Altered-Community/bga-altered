<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_PaintitPink extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_99_R2',
            'asset'  => 'ALT_DUSTER_B_LY_99_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Paint it Pink!"),
      'typeline' => clienttranslate("Spell - Disruption"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('Pretty in pink.'),
      'artist' => "DOBA",
			'extension'=>'SDU',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  Play me for {1} less #per Expedition# <IN_CONTACT> that you control. (They\'re In Contact if another player\'s Expedition is in their region.)  Return target Character or Permanent to the top of its owner\'s deck.'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
