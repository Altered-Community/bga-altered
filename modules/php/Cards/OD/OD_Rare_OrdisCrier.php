<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_OrdisCrier extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_49_R1',
            'asset'  => 'ALT_BISE_B_OR_49_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Ordis Crier"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('He\'s surprisingly happy for someone who cries all day.'),
            'artist' => "Matteo Spirito",
            'extension' => 'WFTM',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('#{R} You may spend 1 of my boosts to ready two Mana Orbs.#'),
            'supportDesc' => clienttranslate('{I} When another Character joins your Expeditions — I gain 1 boost, up to a max of 2.'),
            'supportIcon' => 'infinity',
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 1,
            'costReserve' => 3,
            'changedStats' => ['ocean', 'costReserve'],
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
                        'conditions' => ['isCardAdded:character:::true'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2),
                    ],
                ],
            ],
            'effectReserve' => FT::SEQ_OPTIONAL(
                FT::ACTION(SPEND, [
                    'cardId' => ME,
                    'effect' => FT::SEQ(
                        FT::ACTION(READY, ['cardId' => MANA]),
                        FT::ACTION(READY, ['cardId' => MANA])
                    )
                ])
            ),
        ];
    }
}
