<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Common_HavenTrainer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_DUSTER_B_BR_97_C',
            'asset'  => 'ALT_DUSTER_B_BR_97_C',

    	'faction'  => FACTION_BR,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Haven Trainer"),
      'typeline' => clienttranslate("Character - Trainer"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"Yeah, you\'ve still got a few things to learn…"'),
      'artist' => "Khoa Viet",
			'extension'=>'SDU',
   'subtypes'  => [TRAINER],
 				'effectDesc' => clienttranslate('{H} You may <RUSH> (play another card immediately). If you would play a card from Reserve this way, you may pay its Hand Cost instead of its Reserve Cost.'),
     'forest' => 3, 
     'mountain' => 3, 
     'ocean' => 2, 
     'costHand' => 3, 
     'costReserve' => 3, 
 		'rush' => 'todo',
];
  }
}
