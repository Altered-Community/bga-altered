<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_ManintheMaze extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_57_R1',
            'asset'  => 'ALT_BISE_B_LY_57_R',

    		'faction'  => FACTION_LY,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Man in the Maze"),
            'typeline' => clienttranslate("Character - Deity"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Life is a maze, but our purpose is not to escape it. The purpose of life is the maze itself.'),
            'artist' => "Taras Susak",
			'extension'=>'WFTM',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('{H} Remove all boosts from Characters in play and in Reserve. Then, depending on the number of boosts removed this way:  • #1+#: I gain 2 boosts.  • #5+#: Play a card with Hand Cost {3} or less for free.  • #9+#: My Expedition moves forward one region.'),
     'forest' => 0, 
     'mountain' => 5, 
     'ocean' => 5, 
     'costHand' => 7, 
     'costReserve' => 4, 
];
  }
}
