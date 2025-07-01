<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_LostintheRiptide extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_LY_77_R2',
            'asset'  => 'ALT_CYCLONE_B_LY_77_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Lost in the Riptide"),
      'typeline' => clienttranslate("Spell - Disruption"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('This is why you\'re supposed to read the map...'),
      'artist' => "Anh Tung",
			'extension'=>'SO',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('<FLEETING>.  You may play me for {1} less. If you do, I can only target a Character in {O}.  Return target Character to the top of its owner\'s deck.'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
