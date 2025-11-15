<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_LeonardodaVinci extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_94_R1',
            'asset'  => 'ALT_DUSTER_B_AX_94_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Leonardo da Vinci"),
      'typeline' => clienttranslate("Character - Artist Engineer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"The noblest pleasure is the joy of understanding." — Leonardo da Vinci'),
      'artist' => "Atanas Lozanski",
			'extension'=>'SDU',
   'subtypes'  => [ARTIST,ENGINEER],
 				'effectDesc' => clienttranslate('{R} You may exhaust ({T}) a Permanent you control to #draw a card.#'),
     'forest' => 2, 
     'mountain' => 3, 
     'ocean' => 0, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
