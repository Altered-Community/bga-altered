<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_JuniorChef extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_49_R2',
            'asset'  => 'ALT_BISE_B_BR_49_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Junior Chef"),
            'typeline' => clienttranslate("Character - Animal Apprentice"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('The Bravos are always the best with a blade, whether it\'s in a duel or in the kitchen.'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'WFTM',
            'subtypes'  => [ANIMAL, APPRENTICE],
            'effectDesc' => clienttranslate('#{R} If I have 2 or more boosts, <RESUPPLY_LOW>.#'),
            'supportDesc' => clienttranslate('{I} #At Noon — Choose one:#  • I gain 1 boost, up to a max of 3.  • #{T} : I gain 2 boosts#, up to a max of 3.'),
            'supportIcon' => 'infinity',
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 1,
            'costReserve' => 3,
            'effectReserve' => FT::ACTION(CHECK_CONDITION, [
                'condition' => 'hasBoost:2',
                'description' => clienttranslate('Resupply if the card has 2+ boosts'),
                'effect' => FT::ACTION(RESUPPLY, [])
            ]),
            'blockAutomaticAction' => [GAIN => [BOOST => 1], CHECK_CONDITION => ['hasBoost:2']],
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
