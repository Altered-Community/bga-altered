<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisNightwarden extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_36_C',
            'asset'  => 'ALT_ALIZE_B_OR_36_C',

    		'faction'  => FACTION_OD,
    		'rarity'  => RARITY_COMMON,
    		'name'  => clienttranslate("Ordis Nightwarden"),
            'typeline' => clienttranslate("Character - Bureaucrat"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Work doesn\'t stop when the sun goes down.'),
            'artist' => "Nestor Papatriantafyllou",
			'extension'=>'TBF',
   'subtypes'  => [BUREAUCRAT],
 				'effectDesc' => clienttranslate('When I gain <ASLEEP> — I gain 1 boost.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
