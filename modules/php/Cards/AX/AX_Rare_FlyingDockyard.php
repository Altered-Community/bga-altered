<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_FlyingDockyard extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_BR_82_R2',
            'asset'  => 'ALT_CYCLONE_B_BR_82_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Flying Dockyard"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('"Cast off, and let the hunt begin!" - Sol'),
      'artist' => "Ed Chee, S.Yong & Stephen",
			'extension'=>'SO',
   'subtypes'  => [SITE,LANDMARK],
 				'effectDesc' => clienttranslate('When you pass first — Create an <AEROLITH> token in your Landmarks.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
