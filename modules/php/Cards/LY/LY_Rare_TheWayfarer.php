<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_TheWayfarer extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_62_R1',
            'asset'  => 'ALT_BISE_B_LY_62_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("The Wayfarer"),
            'typeline' => clienttranslate("Landmark Permanent - Construction"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('The Tisdhera Clan answers its Matriarch\'s call!'),
            'artist' => "Fahmi Fauzi",
            'extension' => 'WFTM',
            'subtypes'  => [CONSTRUCTION, LANDMARK],
            'effectDesc' => clienttranslate('If you would roll one or more dice, also reveal the top card of your deck.  When you reveal a card this way — If its Hand Cost is equal to the die\'s result, #you may exhaust me ({T}) to play it for free.# (Don\'t activate any {h} abilities.)'),
            'costHand' => 3,
            'costReserve' => 3,
            'effectPassive' => [
                'ImmediateRollDie' => [
                    'condition' => 'isMe',
                    'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'revealTop'])
                ],
                'RollDie' => [
                    'condition' => ['isMe', 'notTapped', 'isRollEqualCostHand'],
                    'output' => FT::SEQ_OPTIONAL_MANUAL(FT::ACTION(SPECIAL_EFFECT, ['effect' => 'exhaustPlayFree']))
                ]
            ]
        ];
    }
}
