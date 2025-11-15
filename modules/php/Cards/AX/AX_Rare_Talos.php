<?php
namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_Talos extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_OR_96_R2',
            'asset'  => 'ALT_DUSTER_B_OR_96_R',

    	'faction'  => FACTION_AX,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Talos"),
      'typeline' => clienttranslate("Character - Robot"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('It was Talos\'s role to protect the statue from prying eyes.'),
      'artist' => "Taras Susak",
			'extension'=>'SDU',
   'subtypes'  => [ROBOT],
 				'effectDesc' => clienttranslate('<GIGANTIC>.  I\'m <DEFENDER> #unless there are two or more cards in your Landmarks.#'),
     'forest' => 4, 
     'mountain' => 4, 
     'ocean' => 4, 
     'costHand' => 5, 
     'costReserve' => 5, 
 		'gigantic' => true,
];
  }
}
