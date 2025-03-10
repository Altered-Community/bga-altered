<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_FairFox extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_51_R2',
            'asset'  => 'ALT_BISE_B_MU_51_R',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Fair Fox"),
            'typeline' => clienttranslate("Character - Animal"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Should we practice our passing now?'),
            'artist' => "Romain Kurdi",
			'extension'=>'WFTM',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{H} #You may pay {1} to discard target Permanent with Hand Cost {2} or less.# If you do, its controller <RESUPPLIES>.'),
     'forest' => 3, 
     'mountain' => 1, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
