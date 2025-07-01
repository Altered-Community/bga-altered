<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_MothCollision extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_YZ_75_C',
            'asset'  => 'ALT_CYCLONE_B_YZ_75_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Moth Collision"),
      'typeline' => clienttranslate("Spell - Disruption"),
    	'type'  => SPELL,
    	'flavorText'  => clienttranslate('When two moths meet, there\'s always a spark.'),
      'artist' => "Ed Chee, S.Yong & Stephen",
			'extension'=>'SO',
   'subtypes'  => [DISRUPTION],
 				'effectDesc' => clienttranslate('$<FLEETING>.  If you control an Illusion, I cost {1} less.  Discard target Character.'),
     'costHand' => 4, 
     'costReserve' => 4, 
];
  }
}
