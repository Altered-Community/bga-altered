<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Common_AxiomPuppeteer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_72_C',
            'asset'  => 'ALT_CYCLONE_B_AX_72_C',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Axiom Puppeteer"),
      'typeline' => clienttranslate("Character - Engineer Robot"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"In rock-paper-scissors, I always win by a knockout."'),
      'artist' => "Anh Tung",
			'extension'=>'SO',
   'subtypes'  => [ENGINEER,ROBOT],
 				'effectDesc' => clienttranslate('{H} You may sacrifice a Permanent to <SABOTAGE_INF>. (Discard up to one target card from a Reserve.)'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 0, 
     'costHand' => 3, 
     'costReserve' => 2, 
];
  }
}
