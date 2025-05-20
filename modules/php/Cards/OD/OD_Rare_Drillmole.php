<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Drillmole extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_52_R2',
            'asset'  => 'ALT_BISE_B_AX_52_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Drillmole"),
            'typeline' => clienttranslate("Character - Robot"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Not my cabbages!'),
            'artist' => "Anh Tung",
            'extension' => 'WFTM',
            'subtypes'  => [ROBOT],
            'effectDesc' => clienttranslate('{R} You may spend #1 counter# from #a card you control or in your Reserve# to <SABOTAGE_INF>.'),
            'supportDesc' => clienttranslate('{I} #When another Character joins your Expeditions# — I gain 1 boost, up to a #max of 2.#'),
            'supportIcon' => 'infinity',
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 1,
            'costHand' => 2,
            'costReserve' => 3,
            'changedStats' => ['ocean'],
            'effectReserve' => FT::ACTION(
                TARGET,
                [
                    'targetLocation' => CONTROLLED_RESERVE,
                    'targetPlayer' => ME,
                    'augmentOnly' => true,
                    'targetType' => TYPES,
                    'upTo' => true,
                    'effect' => FT::ACTION(SPEND, [
                        'cardId' => EFFECT,
                        'effect' => FT::ACTION(TARGET, [
                            'targetType' => [CHARACTER, SPELL, PERMANENT],
                            'targetLocation' => [RESERVE],
                            'upTo' => true,
                            'effect' => FT::ACTION(DISCARD, []),
                        ])
                    ])
                ]
            ),
            'effectInfinity' => [
                'effectPassive' => [
                    'ChooseAssignment' => [
                        'conditions' => ['isCardAdded:character:::true'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2),
                    ],
                    'InvokeToken' => [
                        'conditions' => ['isCardAdded:character:::true'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2),
                    ],
                    'MoveCard' => [
                        'conditions' => ['isCardAdded:character:::true', 'hasSameOwner'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2),
                    ],
                ],
            ]
        ];
    }
}
