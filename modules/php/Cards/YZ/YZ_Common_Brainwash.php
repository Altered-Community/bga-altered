<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_Brainwash extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_YZ_79_C',
            'asset'  => 'ALT_CYCLONE_B_YZ_79_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Brainwash"),
      'typeline' => clienttranslate("Spell - Disruption"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('Like a worm in an apple, Silk squirmed into the Eidolon\'s mind to convert him to its Faction\'s interests.'),
      'artist' => "DOBA",
			'extension'=>'SO',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  Target a Character in any Reserve with Reserve Cost {2} or less. Play it for free. (Put it in one of your Expeditions. If it would move to your Discard or any other personal zone, it goes to its owner\'s instead.)'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
