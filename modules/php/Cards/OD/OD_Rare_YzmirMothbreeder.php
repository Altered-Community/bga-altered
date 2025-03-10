<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_YzmirMothbreeder extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_59_R2',
            'asset'  => 'ALT_BISE_B_YZ_59_R',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Yzmir Mothbreeder"),
            'typeline' => clienttranslate("Character - Mage"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Have you heard of the butterfly effect?'),
            'artist' => "Victor Canton",
			'extension'=>'WFTM',
   'subtypes'  => [MAGE],
 				'effectDesc' => clienttranslate('$<SCOUT_2> {2}.  {H} Create a <MANA_MOTH> Illusion token in target Expedition.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 4, 
     'costReserve' => 2, 
 		'scout' => 99,
];
  }
}
