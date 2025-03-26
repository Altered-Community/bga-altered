<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_DesignerDrone extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_51_R1',
            'asset'  => 'ALT_BISE_B_AX_51_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Designer Drone"),
            'typeline' => clienttranslate("Character - Robot Engineer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Designed by designers to help them design.'),
            'artist' => "Anh Tung",
            'extension' => 'WFTM',
            'subtypes'  => [ROBOT, ENGINEER],
            'effectDesc' => clienttranslate('#{R} You may spend 1 counter from a card you control or in your Reserve to reduce the cost of the next Permanent you play this Afternoon by {2}.#'),
            'supportDesc' => clienttranslate('{I} At Noon — Choose one:  • I gain 1 boost, up to a max of 3.  • {T} : I gain 2 boosts, up to a max of 3.'),
            'supportIcon' => 'infinity',
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 1,
            'costReserve' => 3,
            'effectReserve' => FT::ACTION(
                TARGET,
                [
                    'targetLocation' => CONTROLLED_RESERVE,
                    'targetPlayer' => ME,
                    'augmentOnly' => true,
                    'targetType' => TYPES,
                    'upTo' => true,
                    'effect' => FT::ACTION(SPEND, ['cardId' => EFFECT, 'effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'costReduction', 'args' => ['type' => PERMANENT, 'reduction' => 2, 'permanent' => true]])])
                ]
            ),
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
            ]
        ];
    }
}
