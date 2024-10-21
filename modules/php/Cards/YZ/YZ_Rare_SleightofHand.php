<?php
namespace ALT\Cards\YZ;

class YZ_Rare_SleightofHand extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_39_R2',
            'asset'  => 'ALT_ALIZE_B_LY_39_R2',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Sleight of Hand"),
            'typeline' => clienttranslate("Spell - Conjuration"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('"An old trick well done is far better than a new trick with no effect." - Houdini'),
            'artist' => "Edward Chee & Seok Yeong",
			'extension'=>'TBF',
   'subtypes'  => [CONJURATION],
 				'effectDesc' => clienttranslate('$<COOLDOWN>.  Exchange target #Spell# in your Reserve with a card from your Hand.'),
     'costHand' => 1, 
     'costReserve' => 1, 
];
  }
}
