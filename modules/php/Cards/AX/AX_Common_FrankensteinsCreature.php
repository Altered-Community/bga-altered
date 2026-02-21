<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_FrankensteinsCreature extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_112_C',
            'asset'  => 'ALT_EOLE_B_AX_112_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Frankenstein's Creature"),
      'typeline' => clienttranslate("Character - Robot"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Gamon Studio",
			'extension'=>'ROC',
   'subtypes'  => [ROBOT],
 				'effectDesc' => clienttranslate('{R} You may target a Permanent you control with Base Cost {2} or less. It activates its {j} abilities.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 3, 
     'effectReserve' => FT::ACTION(TARGET, [
      'targetType' => [PERMANENT],
      'targetPlayer' => ME,
      'upTo' => true,
      'maxBaseCost' => 2,
      'hasEffects' => ['Played'],
      'effect' => FT::ACTION(ACTIVATE_EFFECT, []),
    ]),
];
  }
}
