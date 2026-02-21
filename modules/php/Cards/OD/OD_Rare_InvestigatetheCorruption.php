<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_InvestigatetheCorruption extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_119_R2',
            'asset'  => 'ALT_EOLE_B_YZ_119_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Investigate the Corruption"),
      'typeline' => clienttranslate("Spell - Conjuration"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Nestor Papatriantafyllou",
			'extension'=>'ROC',
   'subtypes'  => [CONJURATION],
 				'effectDesc' => clienttranslate('<FLEETING>.  Draw #three cards,# then discard a card from your hand.'),
     'costHand' => 3, 
     'costReserve' => 3, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
