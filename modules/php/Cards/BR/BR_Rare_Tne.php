<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_Tne extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_MU_77_R2',
            'asset'  => 'ALT_CYCLONE_B_MU_77_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("T?ne"),
      'typeline' => clienttranslate("Character - Druid Deity"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Firmly rooted like a tree, yet free like the birds, he embodies nature\'s strength.'),
      'artist' => "Fahmi Fauzi",
			'extension'=>'SO',
   'subtypes'  => [DRUID,DEITY],
 				'effectDesc' => clienttranslate('#<TOUGH_1>.# (Opponents must pay {1} to target me.)  {J} I gain <ANCHORED>.  {J} Each Animal #and Adventurer# in your Reserve gains 1 boost.'),
     'forest' => 5, 
     'mountain' => 5, 
     'ocean' => 5, 
     'costHand' => 6, 
     'costReserve' => 6, 
     'changedStats' => ['forest','mountain','ocean'], 
 		'tough'=>1,
];
  }
}
