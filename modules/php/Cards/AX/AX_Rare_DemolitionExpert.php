<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_DemolitionExpert extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_AX_67_R1',
            'asset'  => 'ALT_CYCLONE_B_AX_67_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Demolition Expert"),
      'typeline' => clienttranslate("Character - Engineer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Mining aerolith is dangerous, but it\'s well worth the risk.'),
      'artist' => "Victor Canton",
			'extension'=>'SO',
   'subtypes'  => [ENGINEER],
 				'effectDesc' => clienttranslate('{H} Create an <AEROLITH> token in #target player\'s# Landmarks.  {R} You may sacrifice a Permanent #to give 1 boost to target Character.#'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['ocean'], 
];
  }
}
