<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_Thunderbird extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_110_R2',
            'asset'  => 'ALT_EOLE_B_OR_110_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Thunderbird"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "DOBA",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('#{J}# My Expedition <ASCENDS>.  When my Expedition moves forward <DUE_TO_ASCENSION> — Draw a card.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
