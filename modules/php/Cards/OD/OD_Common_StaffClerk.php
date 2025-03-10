<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_StaffClerk extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_51_C',
            'asset'  => 'ALT_BISE_B_OR_51_C',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Staff Clerk"),
            'typeline' => clienttranslate("Character - Bureaucrat"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Don\'t venture into the depths alone.'),
            'artist' => "Romain Kurdi",
			'extension'=>'WFTM',
   'subtypes'  => [BUREAUCRAT],
 				'effectDesc' => clienttranslate('When an opponent plays a card from Reserve — Create an <ORDIS_RECRUIT> Soldier token in my Expedition.'),
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 1, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
