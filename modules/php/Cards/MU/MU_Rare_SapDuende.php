<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_SapDuende extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_61_R2',
            'asset'  => 'ALT_BISE_B_LY_61_R',

    		'faction'  => FACTION_MU,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Sap Duende"),
            'typeline' => clienttranslate("Spell - Song"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('When the rhythm picks up, the strings release the Sap covering them.'),
            'artist' => "Rémi Jacquot",
			'extension'=>'WFTM',
   'subtypes'  => [SONG],
 				'effectDesc' => clienttranslate('<FLEETING>.  Target #two Characters# in play or in Reserve and exchange their boosts.  Draw a card.'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
