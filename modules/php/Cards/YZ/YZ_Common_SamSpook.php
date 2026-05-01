<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_SamSpook extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_105_C',
            'asset'  => 'ALT_EOLE_B_YZ_105_C',

    	'faction'  => FACTION_YZ,
    	'rarity'  => RARITY_COMMON,
    	'name'  => clienttranslate("Sam & Spook"),
      'typeline' => clienttranslate("Yzmir Hero"),
    	'type'  => HERO,
    	'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
			'extension'=>'ROC',
   				'effectDesc' => clienttranslate('{T} : Draw a card, then discard a card from your hand. You can only activate this if you are first player.  When six cards or more are in your discard pile, I permanently gain:  \"When you discard a card from your hand — Return it to your Reserve.\"'),
];
  }
}
