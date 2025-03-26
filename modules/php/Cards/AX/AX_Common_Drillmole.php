<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_Drillmole extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_52_C',
            'asset'  => 'ALT_BISE_B_AX_52_C',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Drillmole"),
            'typeline' => clienttranslate("Character - Robot"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Not my cabbages!'),
            'artist' => "Anh Tung",
            'extension' => 'WFTM',
            'subtypes'  => [ROBOT],
            'effectDesc' => clienttranslate('{R} You may spend 1 of my boosts to <SABOTAGE_INF>. (Discard up to one target card from a Reserve.)'),
            'supportDesc' => clienttranslate('{I} At Noon — Choose one:  • I gain 1 boost, up to a max of 3.  • {T} : I gain 2 boosts, up to a max of 3.'),
            'supportIcon' => 'infinity',
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 0,
            'costHand' => 2,
            'costReserve' => 3,
            'effectInfinity' => [
                'effectPassive' => [
                    'Noon' => [
                        'condition' => 'isMe',
                        'output' => FT::XOR(
                            FT::ACTION(GAIN, ['cardId' => ME, 'type' => BOOST, 'upTo' => 3]),
                            FT::SEQ(
                                FT::ACTION(TAP, []),
                                FT::ACTION(GAIN, ['cardId' => ME, 'type' => BOOST, 'n' => 2, 'upTo' => 3]),
                            )
                        ),
                    ],
                ],
            ],
            'effectReserve' => FT::SEQ_OPTIONAL(
                FT::ACTION(SPEND, ['cardId' => ME, 'effect' => FT::ACTION(TARGET, [
                    'targetType' => [CHARACTER, SPELL, PERMANENT],
                    'targetLocation' => [RESERVE],
                    'upTo' => true,
                    'effect' => FT::ACTION(DISCARD, []),
                ]),])
            ),
        ];
    }
}
