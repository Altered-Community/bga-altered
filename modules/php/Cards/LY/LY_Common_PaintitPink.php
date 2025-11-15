<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_PaintitPink extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_99_C',
            'asset'  => 'ALT_DUSTER_B_LY_99_C',

    	'faction'  => FACTION_LY,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Paint it Pink!"),
      'typeline' => clienttranslate("Spell - Disruption"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('Pretty in pink.'),
      'artist' => "DOBA",
			'extension'=>'SDU',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  Play me for {1} less if one or more of your Expeditions are <IN_CONTACT>. (If another player\'s Expedition is in their region.)  Return target Character or Permanent to the top of its owner\'s deck.'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
