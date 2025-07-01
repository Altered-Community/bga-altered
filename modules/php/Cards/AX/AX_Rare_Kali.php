<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_Kali extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_YZ_71_R2',
            'asset'  => 'ALT_CYCLONE_B_YZ_71_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Kali"),
      'typeline' => clienttranslate("Character - Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Each action requires a sacrifice.'),
      'artist' => "Zero Wen",
			'extension'=>'SO',
   'subtypes'  => [DEITY],
 				'effectDesc' => clienttranslate('{H} You may put a #Permanent# from your hand in Reserve. If you don\'t, sacrifice #a Permanent.#'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['mountain'], 
];
  }
}
