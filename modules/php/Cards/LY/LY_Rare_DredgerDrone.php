<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_DredgerDrone extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_50_R2',
            'asset'  => 'ALT_BISE_B_AX_50_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Dredger Drone"),
            'typeline' => clienttranslate("Character - Robot"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('The more you dig, the better your chances of finding something unique.'),
            'artist' => "Anh Tung",
            'extension' => 'WFTM',
            'subtypes'  => [ROBOT],
            'effectDesc' => clienttranslate('{R} You may spend #1 counter# from #a card you control or in your Reserve# to <RESUPPLY_INF>.'),
            'supportDesc' => clienttranslate('{I} #When you play another Character with a base statistic of 0# — I gain 1 boost, up to a #max of 2.#'),
            'supportIcon' => 'infinity',
            'forest' => 0,
            'mountain' => 2,
            'ocean' => 2,
            'costHand' => 2,
            'costReserve' => 3,
            'changedStats' => ['forest'],
            'effectReserve' => FT::ACTION(
                TARGET,
                [
                    'targetLocation' => CONTROLLED_RESERVE,
                    'targetPlayer' => ME,
                    'augmentOnly' => true,
                    'targetType' => TYPES,
                    'upTo' => true,
                    'effect' => FT::ACTION(SPEND, ['cardId' => EFFECT, 'effect' => FT::ACTION(RESUPPLY, [])])
                ]
            ),
            'effectInfinity' => [
                'effectPassive' => [
                    'ChooseAssignment' => [
                        'conditions' => ['isCardPlayedWithZeroStat', 'excludeSelf'],
                        'output' => FT::ACTION(GAIN, ['cardId' => ME, 'upTo' => 2, 'type' => BOOST])
                    ]
                ]
            ]

        ];
    }
}
