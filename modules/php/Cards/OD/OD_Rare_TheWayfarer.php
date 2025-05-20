<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_TheWayfarer extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_62_R2',
            'asset'  => 'ALT_BISE_B_LY_62_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("The Wayfarer"),
            'typeline' => clienttranslate("Landmark Permanent - Construction"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('The Tisdhera Clan answers its Matriarch\'s call!'),
            'artist' => "Fahmi Fauzi",
            'extension' => 'WFTM',
            'subtypes'  => [CONSTRUCTION, LANDMARK],
            'effectDesc' => clienttranslate('#When you play a Bureaucrat — Roll a die# and reveal the top card of your deck.  When you reveal a card this way — If its Hand Cost is equal to the die\'s result, draw it.'),
            'costHand' => 3,
            'costReserve' => 3,
            'effectPassive' => [
                'ChooseAssignment' => [
                    'condition' => 'isCardPlayed:bureaucrat',
                    'output' => FT::ACTION(ROLL_DIE, ['effect' =>
                    ['1+' =>
                    FT::SEQ(FT::ACTION(SPECIAL_EFFECT, ['effect' => 'revealTop']), FT::ACTION(SPECIAL_EFFECT, ['effect' => 'drawTopIfRoll', 'roll' => 'die']))]])
                ],
            ],

        ];
    }
}
