<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_Lakshmi extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_55_R1',
            'asset'  => 'ALT_BISE_B_LY_55_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Lakshmi"),
            'typeline' => clienttranslate("Character - Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Fortune smiles on those who give themselves over to it.'),
            'artist' => "Taras Susak",
            'extension' => 'WFTM',
            'subtypes'  => [DEITY],
            'effectDesc' => clienttranslate('When you roll one or more dice — #If the result is 6+, draw a card.#'),
            'supportDesc' => clienttranslate('#{I} When you roll one or more dice — I gain 1 boost, up to a max of 2.#'),
            'supportIcon' => 'infinity',
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 2,
            'costHand' => 3,
            'costReserve' => 3,
            'effectPassive' => [
                'RollDie' => [
                    'conditions' => ['isMe', 'selectedRoll:6'],
                    'output' => FT::ACTION(DRAW, ['players' => ME])
                ]
            ],
            'effectInfinity' => [
                'effectPassive' => [
                    'RollDie' => [
                        'condition' => 'isMe',
                        'output' => FT::GAIN(ME, BOOST, 1, 2)
                    ]
                ]
            ]
        ];
    }
}
