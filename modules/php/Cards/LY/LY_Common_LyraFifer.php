<?php

namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_LyraFifer extends \ALT\Models\Card
{
    public function __construct($row){
		  parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_109_C',
            'asset'  => 'ALT_EOLE_B_LY_109_C',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Lyra Fifer"),
            'typeline' => clienttranslate("Character - Artist"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Don\'t they say that he who pays the piper calls the tune?'),
            'artist' => "Zero Wen",
            'extension'=>'ROC',
            'subtypes'  => [ARTIST],
            'effectDesc' => clienttranslate('{J} If a card in your Expeditions or your Reserve has a {D} ability, I gain 1 boost $<BB>.'),
            'forest' => 2, 
            'mountain' => 1, 
            'ocean' => 1, 
            'costHand' => 2, 
            'costReserve' => 2, 
            'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'hasOtherSupportCardInReserveOrExpeditions', 'effect' => FT::GAIN(ME, BOOST)]),
        ];
    }
}