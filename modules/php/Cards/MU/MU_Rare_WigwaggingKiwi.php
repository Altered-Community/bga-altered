<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_WigwaggingKiwi extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_OR_111_R2',
            'asset'  => 'ALT_EOLE_B_OR_111_R',

    	'faction'  => FACTION_MU,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Wigwagging Kiwi"),
      'typeline' => clienttranslate("Character - Animal"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zaeliven",
			'extension'=>'ROC',
   'subtypes'  => [ANIMAL],
 				'effectDesc' => clienttranslate('{J} I gain 1 boost per other #Animal in your Expeditions, up to a max of 2 boosts on me.#'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['mountain','ocean'], 
];
  }
}
