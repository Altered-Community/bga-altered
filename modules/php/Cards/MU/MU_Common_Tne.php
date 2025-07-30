<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Common_Tne extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_MU_77_C',
            'asset'  => 'ALT_CYCLONE_B_MU_77_C',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("T?ne"),
      'typeline' => clienttranslate("Character - Druid Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Firmly rooted like a tree, yet free like the birds, he embodies nature\'s strength.'),
      'artist' => "Fahmi Fauzi",
			'extension'=>'SO',
   'subtypes'  => [DRUID,DEITY],
 				'effectDesc' => clienttranslate('{J} I gain $<ANCHORED>.  {J} Each Animal in your Reserve gains 1 boost.'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 6, 
     'costReserve' => 6, 
];
  }
}
