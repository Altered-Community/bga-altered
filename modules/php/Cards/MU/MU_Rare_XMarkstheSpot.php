<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_XMarkstheSpot extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_60_R2',
            'asset'  => 'ALT_BISE_B_LY_60_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("X Marks the Spot"),
            'typeline' => clienttranslate("Spell - Disruption"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('As Xpected.'),
            'artist' => "HuoMiao Studio",
            'extension' => 'WFTM',
            'subtypes'  => [DISRUPTION],
            'effectDesc' => clienttranslate('<FLEETING>.  Roll a die. Send target Character to the Xth position of its owner\'s deck, where X is the result. #If X is higher than the Hand Cost of the target, ready one mana Orb.#'),
            'costHand' => 3,
            'costReserve' => 3,
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::ACTION(
                    ROLL_DIE,
                    [
                        'effect' => [
                            '1+' => FT::ACTION(TARGET, [
                                'effect' => FT::ACTION(DISCARD, ['destination' => 'topOfDeck', 'position' => 'die', 'readyIfCostLower' => true]),
                            ])
                        ]
                    ]
                )
            )
        ];
    }
}
