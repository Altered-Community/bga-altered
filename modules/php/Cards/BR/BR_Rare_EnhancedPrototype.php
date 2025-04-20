<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_EnhancedPrototype extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_57_R2',
            'asset'  => 'ALT_BISE_B_AX_57_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Enhanced Prototype"),
            'typeline' => clienttranslate("Character - Robot"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('It\'s no longer flawed, but there\'s still room for improvement.'),
            'artist' => "Anh Tung",
            'extension' => 'WFTM',
            'subtypes'  => [ROBOT],
            'effectDesc' => clienttranslate('{R} You may spend #1 counter# from #a card you control or in your Reserve# to ready two Mana Orbs.'),
            'supportDesc' => clienttranslate('{I} #When you play another Character# — I gain 1 boost, up to a max of 3.'),
            'supportIcon' => 'infinity',
            'forest' => 5,
            'mountain' => 5,
            'ocean' => 5,
            'costHand' => 5,
            'costReserve' => 6,
            'effectReserve' => FT::ACTION(
                TARGET,
                [
                    'targetLocation' => CONTROLLED_RESERVE,
                    'targetPlayer' => ME,
                    'augmentOnly' => true,
                    'targetType' => TYPES,
                    'upTo' => true,
                    'effect' => FT::ACTION(SPEND, [
                        'effect' => FT::SEQ(
                            FT::ACTION(READY, ['cardId' => MANA]),
                            FT::ACTION(READY, ['cardId' => MANA])
                        )
                    ])
                ]
            ),
            'effectInfinity' => [
                'effectPassive' => [
                    'ChooseAssignment' => [
                        'conditions' => ['isCardPlayed:character:::true', 'excludeSelf'],
                        'output' => FT::ACTION(GAIN, ['cardId' => ME, 'upTo' => 3, 'type' => BOOST])
                    ]
                ]
            ]
        ];
    }
}
