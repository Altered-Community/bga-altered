<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_DeepCloudInstructor extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_95_C',
            'asset'  => 'ALT_DUSTER_B_BR_95_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Deep-Cloud Instructor"),
      'typeline' => clienttranslate("Character - Trainer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('Without this suit, diving into the Tumult would be a death sentence.'),
      'artist' => "Victor Canton",
			'extension'=>'SDU',
   'subtypes'  => [TRAINER],
 				'effectDesc' => clienttranslate('{H} You may <RUSH> a Character. If played from your hand, it activates one of its {r} abilities. (Rush means playing it immediately.)  {R} I gain 2 boosts.'),
     'forest' => 1, 
     'mountain' => 3, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 4, 
 		'rush' => 'todo',
];
  }
}
