<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_MothcatcherWand extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_YZ_101_R1',
            'asset'  => 'ALT_DUSTER_B_YZ_101_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Mothcatcher Wand"),
      'typeline' => clienttranslate("Expedition_permanent - Gear"),
    	'type'  => PERMANENT,
    	'flavorText'  => clienttranslate('Moyo uses it to capture the essence of illusion.'),
      'artist' => "HuoMiao Studio",
			'extension'=>'SDU',
   'subtypes'  => [GEAR,EXPEDITION],
 				'effectDesc' => clienttranslate('{J} Exhaust target card in Reserve.  {T}, {X} : Create X <MANA_MOTH> Illusion tokens in my Expedition. X can\'t be higher than the total number of exhausted cards in Reserve and #other exhausted Permanents you control.#'),
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
