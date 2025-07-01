<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_AxiomSignet extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_76_C',
            'asset'  => 'ALT_CYCLONE_B_AX_76_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Axiom Signet"),
      'typeline' => clienttranslate("Spell - Conjuration"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('Humanism and progress.'),
      'artist' => "Jean-Baptiste Andrier",
			'extension'=>'SO',
   'subtypes'  => [CONJURATION],
 				'effectDesc' => clienttranslate('Choose one:  • Create a <BRASSBUG> Robot token in target Expedition.  • Target Permanent you control activates its {j} abilities.  • Discard target Permanent with Hand Cost {3} or less.'),
     'costHand' => 2, 
     'costReserve' => 4, 
];
  }
}
