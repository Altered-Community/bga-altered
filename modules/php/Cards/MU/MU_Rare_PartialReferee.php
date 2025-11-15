<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_PartialReferee extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_YZ_93_R2',
            'asset'  => 'ALT_DUSTER_B_YZ_93_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Partial Referee"),
      'typeline' => clienttranslate("Character - Bureaucrat Rogue"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Red card! Out!"'),
      'artist' => "Abigael Giroud",
			'extension'=>'SDU',
   'subtypes'  => [BUREAUCRAT,ROGUE],
 				'effectDesc' => clienttranslate('{H} Discard target Character #or Permanent.# If its Base Cost was {3} or more, its controller draws a card. (Its Base Cost is the Reserve Cost if Fleeting, or the Hand Cost if not.)'),
     'forest' => 3, 
     'mountain' => 4, 
     'ocean' => 3, 
     'costHand' => 5, 
     'costReserve' => 3, 
     'changedStats' => ['forest','ocean'], 
];
  }
}
