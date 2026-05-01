<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_SneakySalamander extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_AX_106_C',
            'asset'  => 'ALT_EOLE_B_AX_106_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Sneaky Salamander"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Khoa Viet",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} You may put a card from your hand in Reserve.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 0, 
     'costHand' => 1, 
     'costReserve' => 1, 
     'effectHand' => FT::ACTION(TARGET, [
      'targetType' => [CHARACTER, SPELL, PERMANENT],
      'targetPlayer' => ME,
      'targetLocation' => [HAND],
      'upTo' => true,
      'effect' => FT::DISCARD_TO_RESERVE(),
    ]),
];
  }
}
