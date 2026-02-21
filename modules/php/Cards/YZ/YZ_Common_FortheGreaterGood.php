<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_FortheGreaterGood extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_117_C',
            'asset'  => 'ALT_EOLE_B_YZ_117_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("For the Greater Good"),
      'typeline' => clienttranslate("Spell - Disruption"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  Discard a card from your hand. If you do, discard target card in play with Base Cost {3} or less. (Its Base Cost is the Reserve Cost if Fleeting, the Hand Cost otherwise.)'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
