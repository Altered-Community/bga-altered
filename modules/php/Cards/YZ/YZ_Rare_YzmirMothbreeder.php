<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_YzmirMothbreeder extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_59_R1',
            'asset'  => 'ALT_BISE_B_YZ_59_R',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Yzmir Mothbreeder"),
            'typeline' => clienttranslate("Character - Mage"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Have you heard of the butterfly effect?'),
            'artist' => "Victor Canton",
			'extension'=>'WFTM',
   'subtypes'  => [MAGE],
 				'effectDesc' => clienttranslate('$<SCOUT_2> {2}.  {H} Create a <MANA_MOTH> Illusion token in target Expedition.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 3, 
     'costReserve' => 1, 
     'changedStats' => ['forest','mountain','ocean','costHand','costReserve'], 
 		'scout' => 99,
];
  }
}
