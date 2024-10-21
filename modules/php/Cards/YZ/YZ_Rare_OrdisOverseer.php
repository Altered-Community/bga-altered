<?php
namespace ALT\Cards\YZ;

class YZ_Rare_OrdisOverseer extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_34_R2',
            'asset'  => 'ALT_ALIZE_B_OR_34_R2',

    		'faction'  => FACTION_YZ,
    		'rarity'  => RARITY_RARE,
    		'name'  => clienttranslate("Ordis Overseer"),
            'typeline' => clienttranslate("Character - Bureaucrat Soldier"),
    		'type'  => CHARACTER,
    		'flavorText'  => clienttranslate('Proper resource allocation can help make up for lost ground.'),
            'artist' => "Zael",
			'extension'=>'TBF',
   'subtypes'  => [BUREAUCRAT,SOLDIER],
 				'effectDesc' => clienttranslate('{J} If my Expedition is behind, create an <ORDIS_RECRUIT> Soldier token in my Expedition.'),
 				'supportDesc' => clienttranslate('{D} : Create an <ORDIS_RECRUIT> Soldier token in target Expedition. (Discard me from Reserve to do this.)'),
 			     'supportIcon' => 'discard',
     'forest' => 1, 
     'mountain' => 1, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
];
  }
}
