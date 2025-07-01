<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_BravosSignet extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_BR_79_R2',
            'asset'  => 'ALT_CYCLONE_B_BR_79_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Bravos Signet"),
      'typeline' => clienttranslate("Spell - Conjuration"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('Courage and excellence.'),
      'artist' => "Ed Chee, S.Yong & Stephen",
			'extension'=>'SO',
   'subtypes'  => [CONJURATION],
 				'effectDesc' => clienttranslate('#<FLEETING>.#  Choose #two:#  • Target Character gains 3 boosts.  • Return target Character with Hand Cost {3} or less to its owner\'s hand.  • Put the top card of your deck in your Mana zone (as an exhausted Mana Orb).'),
     'costHand' => 5, 
     'costReserve' => 5, 
     'changedStats' => ['costHand','costReserve'], 
];
  }
}
