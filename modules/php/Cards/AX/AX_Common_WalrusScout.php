<?php
namespace ALT\Cards\AX;

class AX_Common_WalrusScout extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_36_C',
            'asset'  => 'ALT_ALIZE_B_AX_36_C',

    		'faction'  => FACTION_AX,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Walrus Scout"),
            'typeline' => clienttranslate("Character - Animal"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('"Goo goo g\'joob, g\'goo goo g\'joob"'),
            'artist' => "Jean-Baptiste Andrier",
			'extension'=>'TBF',
   'subtypes'  => [ANIMAL],
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 3, 
     'costHand' => 3, 
     'costReserve' => 1, 
];
  }
}
