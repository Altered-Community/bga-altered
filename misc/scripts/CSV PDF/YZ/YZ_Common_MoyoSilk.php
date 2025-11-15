<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_MoyoSilk extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_YZ_65_C',
            'asset'  => 'ALT_DUSTER_B_YZ_65_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Moyo & Silk"),
      'typeline' => clienttranslate("Yzmir Hero"),
    	'type'  => HERO,
    	'flavorText'  => clienttranslate('The idea of the butterfly resides within the caterpillar'),
      'artist' => "Taras Susak",
			'extension'=>'SDU',
   				'effectDesc' => clienttranslate('When you play a Spell with Base Cost {4} or more — You may exhaust me ({T}) to create a <MANA_MOTH> Illusion token in your Hero Expedition. If the Base Cost was {7} or more, also draw a card. (It\'s the Reserve Cost if played from Reserve, or the Hand Cost if not.)'),
];
  }
}
