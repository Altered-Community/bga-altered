<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_XMarkstheSpot extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_60_C',
            'asset'  => 'ALT_BISE_B_LY_60_C',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("X Marks the Spot"),
            'typeline' => clienttranslate("Spell - Disruption"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('As Xpected.'),
            'artist' => "HuoMiao Studio",
            'extension' => 'WFTM',
            'subtypes'  => [DISRUPTION],
            'effectDesc' => clienttranslate('$<FLEETING>.  Roll a die. Send target Character to the Xth position of its owner\'s deck, where X is the result.'),
            'costHand' => 3,
            'costReserve' => 3,
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::ACTION(
                    ROLL_DIE,
                    [
                        'effect' => [
                            '1+' => FT::ACTION(TARGET, [
                                'effect' => FT::ACTION(DISCARD, ['destination' => 'topOfDeck', 'position' => 'die']),
                            ])
                        ]
                    ]
                )
            )
        ];
    }
}
