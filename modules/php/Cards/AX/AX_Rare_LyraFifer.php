<?php

namespace ALT\Cards\AX;
use ALT\Helpers\FT;

class AX_Rare_LyraFifer extends \ALT\Models\Card
{
    public function __construct($row){
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_109_R2',
            'asset'  => 'ALT_EOLE_B_LY_109_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Lyra Fifer"),
            'typeline' => clienttranslate("Character - Artist"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Don\'t they say that he who pays the piper calls the tune?'),
            'artist' => "Zero Wen",
            'extension'=>'ROC',
            'subtypes'  => [ARTIST],
            'effectDesc' => clienttranslate('If a #{T}# ability #was activated this turn#, I gain 1 boost.'),
            'supportDesc' => clienttranslate(
                '#{D} : The next Character you play this turn gains 1 boost. (Discard me from Reserve to do this.)#'
            ),
            'supportIcon' => 'discard',
            'forest' => 2, 
            'mountain' => 2, 
            'ocean' => 2, 
            'costHand' => 2, 
            'costReserve' => 2,
            'changedStats' => ['ocean','mountain'],
            'effectPlayed' => FT::ACTION(CHECK_CONDITION, 
            [
                'condition' => 'checkAbilityActivatedThisTurn:tap', 
                'effect' => FT::GAIN(ME, BOOST)
            ]),
            'effectSupport' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains1Boost']),
        ];
    }
}