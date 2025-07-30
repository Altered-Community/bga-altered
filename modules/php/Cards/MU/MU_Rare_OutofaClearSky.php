<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_OutofaClearSky extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_77_R2',
            'asset'  => 'ALT_CYCLONE_B_OR_77_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Out of a Clear Sky"),
      'typeline' => clienttranslate("Spell - Disruption"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('A swarm of messages bursts forth in a rustling of paper.'),
      'artist' => "Zero Wen",
			'extension'=>'SO',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  I cost #{2} less# if at least one of your Expeditions is Ascended.  Send target Character to Reserve.'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
