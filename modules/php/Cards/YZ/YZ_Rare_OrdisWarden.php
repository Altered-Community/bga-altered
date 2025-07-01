<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_OrdisWarden extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_CYCLONE_B_OR_68_R2',
            'asset'  => 'ALT_CYCLONE_B_OR_68_R',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Ordis Warden"),
      'typeline' => clienttranslate("Character - Bureaucrat"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('You can\'t beat the clink for catching forty winks.'),
      'artist' => "Justice Wong",
			'extension'=>'SO',
   'subtypes'  => [BUREAUCRAT],
 				'effectDesc' => clienttranslate('{H} #You may have me# gain <ASLEEP>.  At Noon — Target player puts a card from their hand in Reserve.'),
     'forest' => 2, 
     'mountain' => 2, 
     'ocean' => 2, 
     'costHand' => 2, 
     'costReserve' => 2, 
     'changedStats' => ['costHand'], 
];
  }
}
