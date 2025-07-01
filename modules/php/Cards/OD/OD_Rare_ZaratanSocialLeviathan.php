<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Rare_ZaratanSocialLeviathan extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_MU_74_R2',
            'asset'  => 'ALT_CYCLONE_B_MU_74_R',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Zaratan, Social Leviathan"),
      'typeline' => clienttranslate("Character - Leviathan"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('We were sailing among the islands when one of them came to meet us.'),
      'artist' => "Ba Vo",
			'extension'=>'SO',
   'subtypes'  => [LEVIATHAN],
 				'effectDesc' => clienttranslate('<GIGANTIC>.  #{J} Create a <WOOLLYBACK> Animal token in target Expedition.#  {J} I gain 1 boost per Character in the Expeditions facing me.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 5, 
     'costReserve' => 5, 
 		'gigantic' => true,
];
  }
}
