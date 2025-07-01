<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_AleloEerieLeviathan extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_YZ_73_R1',
            'asset'  => 'ALT_CYCLONE_B_YZ_73_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Alelo, Eerie Leviathan"),
      'typeline' => clienttranslate("Character - Leviathan"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('We followed in its wake, believing it was a magical current.'),
      'artist' => "Matteo Spirito",
			'extension'=>'SO',
   'subtypes'  => [LEVIATHAN],
 				'effectDesc' => clienttranslate('<GIGANTIC>.  I\'m also considered a Spell, even when not in play. (Play me as a Character, but it counts as playing a Spell for other abilities.)'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 4, 
     'costReserve' => 4, 
     'changedStats' => ['forest','mountain','ocean','costHand','costReserve'], 
 		'gigantic' => true,
];
  }
}
