<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_FloreFumingGardener extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_MU_90_R1',
            'asset'  => 'ALT_DUSTER_B_MU_90_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Flore, Fuming Gardener"),
      'typeline' => clienttranslate("Character - Druid"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"The Naos has been drained from intensive use!"'),
      'artist' => "Zael",
			'extension'=>'SDU',
   'subtypes'  => [DRUID],
 				'effectDesc' => clienttranslate('{J} You may exhaust ({T}) target Permanent in play. #Then you may exhaust# target card in Reserve.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 3, 
];
  }
}
