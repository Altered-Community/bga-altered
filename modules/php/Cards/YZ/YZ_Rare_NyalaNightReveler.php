<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_NyalaNightReveler extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_LY_90_R2',
            'asset'  => 'ALT_DUSTER_B_LY_90_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Nyala, Night Reveler"),
      'typeline' => clienttranslate("Character - Mage"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"I can get in anywhere, VIP list or not."'),
      'artist' => "DOBA",
			'extension'=>'SDU',
   'subtypes'  => [MAGE],
 				'effectDesc' => clienttranslate('{H} If I\'m <IN_CONTACT>, you may exchange a card from your Reserve with a card from your hand. (I\'m In Contact if another player\'s Expedition is in my region.)'),
 				'supportDesc' => clienttranslate('#{D} : Exchange another card from your Reserve with a card from your hand.#'),
 			     'supportIcon' => 'discard',
     'forest' => 0, 
     'mountain' => 3, 
     'ocean' => 3, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['mountain'], 
];
  }
}
