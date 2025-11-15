<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_DeepCloudInstructor extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_95_R1',
            'asset'  => 'ALT_DUSTER_B_BR_95_R',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Deep-Cloud Instructor"),
      'typeline' => clienttranslate("Character - Trainer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Without this suit, diving into the Tumult would be a death sentence.'),
      'artist' => "Victor Canton",
			'extension'=>'SDU',
   'subtypes'  => [TRAINER],
 				'effectDesc' => clienttranslate('#{J}# You may <RUSH> a Character. If played from your hand, it activates one of its {r} abilities.  {R} I gain #1 boost.#'),
     'forest' => 1, 
     'mountain' => 3, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 3, 
     'changedStats' => ['costReserve'], 
 		'rush' => 'todo',
];
  }
}
