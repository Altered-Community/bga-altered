<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_NightclubBouncer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_94_R2',
            'asset'  => 'ALT_DUSTER_B_LY_94_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Nightclub Bouncer"),
      'typeline' => clienttranslate("Character - Citizen"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"What part of \'dress code\' do you not understand?"'),
      'artist' => "Gamon Studio",
			'extension'=>'SDU',
   'subtypes'  => [CITIZEN],
 				'effectDesc' => clienttranslate('#{J}# If I\'m <IN_CONTACT>, <SABOTAGE_LOW>. #Otherwise, you may exhaust ({T}) target card in Reserve.# (I\'m In Contact if another player\'s Expedition is in my region.)'),
     'forest' => 4, 
     'mountain' => 0, 
     'ocean' => 4, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
