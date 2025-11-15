<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_DellaBolt extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_AX_85_C',
            'asset'  => 'ALT_DUSTER_B_AX_85_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Della & Bolt"),
      'typeline' => clienttranslate("Axiom Hero"),
    	'type'  => HERO,
    	'flavorText'  => clienttranslate('Living creatures are the most beautiful mechanisms of all.'),
      'artist' => "Tristan Bideau",
			'extension'=>'SDU',
   				'effectDesc' => clienttranslate('{T} : Ready target Permanent in play or target card in Reserve. This costs {2} more to target a Permanent in play with Hand Cost {5} or more.'),
];
  }
}
