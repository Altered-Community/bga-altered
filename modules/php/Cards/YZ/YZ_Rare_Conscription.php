<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_Conscription extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_60_R2',
            'asset'  => 'ALT_BISE_B_OR_60_R',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Conscription"),
            'typeline' => clienttranslate("Spell - Maneuver"),
    		'type'  => SPELL,
    		'flavorText'  => clienttranslate('You\'re in the army now.'),
            'artist' => "Romain Kurdi",
			'extension'=>'WFTM',
   'subtypes'  => [MANEUVER],
 				'effectDesc' => clienttranslate('#<COOLDOWN>.# (If I go to Reserve after my effect resolves, exhaust me {T}. Exhausted cards can\'t be played and have no Support abilities.)  Target an Expedition. Create X <ORDIS_RECRUIT> Soldier tokens in it, where X is the number of cards in target player\'s Reserve.'),
     'costHand' => 2, 
     'costReserve' => 2, 
 		'cooldown' => true,
];
  }
}
