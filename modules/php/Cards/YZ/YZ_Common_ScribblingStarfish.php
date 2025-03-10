<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_ScribblingStarfish extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_49_C',
            'asset'  => 'ALT_BISE_B_YZ_49_C',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Scribbling Starfish"),
            'typeline' => clienttranslate("Character - Animal"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('A good Sigil starts with a good sketch.'),
            'artist' => "Zero Wen",
			'extension'=>'WFTM',
   'subtypes'  => [ANIMAL],
 				'supportDesc' => clienttranslate('{I} When you play a Spell — I gain 1 boost, up to a max of 2.'),
 			     'supportIcon' => 'infinity',
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 1, 
     'costReserve' => 2, 
];
  }
}
