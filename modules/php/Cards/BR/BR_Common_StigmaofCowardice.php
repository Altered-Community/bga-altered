<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_StigmaofCowardice extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_BR_114_C',
            'asset'  => 'ALT_EOLE_B_BR_114_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Stigma of Cowardice"),
      'typeline' => clienttranslate("Character - Corruption"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Khoa Viet",
			'extension'=>'ROC',
   'subtypes'  => [CORRUPTION],
 				'effectDesc' => clienttranslate('{J} Pass.  When an opponent passes — You may play a Character. (Paying its cost normally.)'),
     'forest' => 5, 
     'mountain' => 5, 
     'ocean' => 5, 
     'costHand' => 5, 
     'costReserve' => 5, 
     'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'allPass']),
     'effectPassive' => [
      'EndTurn' => [
        [
          'conditions' => ['isNotMe'],
          'output' => FT::ACTION(CHOOSE_ASSIGNMENT, ['actions' => ['play'], 'types' => [CHARACTER]], ['optional' => true]),
        ],
      ],
    ],
];
  }
}
