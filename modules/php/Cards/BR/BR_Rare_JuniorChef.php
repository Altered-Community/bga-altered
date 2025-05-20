<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_JuniorChef extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_49_R1',
            'asset'  => 'ALT_BISE_B_BR_49_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Junior Chef"),
            'typeline' => clienttranslate("Character - Animal Apprentice"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('The Bravos are always the best with a blade, whether it\'s in a duel or in the kitchen.'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'WFTM',
            'subtypes'  => [ANIMAL, APPRENTICE],
            'effectDesc' => clienttranslate('#{R} If I have 2 or more boosts, <RESUPPLY_LOW>.#'),
            'supportDesc' => clienttranslate('{I} When you play another Character — I gain 1 boost, up to a max of 3.'),
            'supportIcon' => 'infinity',
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 1,
            'costReserve' => 3,
            'effectInfinity' => [
                'effectPassive' => [
                    'ChooseAssignment' => [
                        'condition' => 'isCardPlayed:character',
                        'output' => FT::GAIN(ME, BOOST, 1, 3),
                    ],
                ]
            ],
            'effectReserve' => FT::ACTION(CHECK_CONDITION, [
                'condition' => 'hasBoost:2',
                'description' => clienttranslate('Resupply if the card has 2+ boosts'),
                'effect' => FT::ACTION(RESUPPLY, [])
            ]),
            'blockAutomaticAction' => [GAIN => [BOOST => 1], CHECK_CONDITION => ['hasBoost:2']],
        ];
    }
}
