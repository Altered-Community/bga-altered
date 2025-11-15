<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_TeamMascot extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_YZ_96_R2',
            'asset'  => 'ALT_DUSTER_B_YZ_96_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Team Mascot"),
      'typeline' => clienttranslate("Character - Artist"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('She gets the substitutes fired up so they\'re ready to take the field.'),
      'artist' => "Justice Wong",
			'extension'=>'SDU',
   'subtypes'  => [ARTIST],
 				'effectDesc' => clienttranslate('{J} If there are #two or more# exhausted cards in Reserve, #up to two target Characters# each gain 1 boost.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
