<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_EnhancedPrototype extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_57_R1',
            'asset'  => 'ALT_BISE_B_AX_57_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Enhanced Prototype"),
            'typeline' => clienttranslate("Character - Robot"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('It\'s no longer flawed, but there\'s still room for improvement.'),
            'artist' => "Anh Tung",
            'extension' => 'WFTM',
            'subtypes'  => [ROBOT],
            'effectDesc' => clienttranslate('{R} You may spend #1 counter# from #a card you control or in your Reserve# to ready two Mana Orbs.'),
            'supportDesc' => clienttranslate('{I} At Noon — Choose one:  • I gain 1 boost, up to a max of 3.  • {T} : I gain 2 boosts, up to a max of 3.'),
            'supportIcon' => 'infinity',
            'forest' => 5,
            'mountain' => 5,
            'ocean' => 5,
            'costHand' => 5,
            'costReserve' => 6,
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
            'effectReserve' => FT::ACTION(
                TARGET,
                [
                    'targetLocation' => CONTROLLED_RESERVE,
                    'targetPlayer' => ME,
                    'augmentOnly' => true,
                    'targetType' => TYPES,
                    'upTo' => true,
                    'effect' => FT::ACTION(SPEND, [
                        'cardId' => ME,
                        'effect' => FT::SEQ(
                            FT::ACTION(READY, ['cardId' => MANA]),
                            FT::ACTION(READY, ['cardId' => MANA])
                        )
                    ])
                ]
            )
        ];
    }
}
