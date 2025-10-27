<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_OrdisAccountant extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_50_R1',
            'asset'  => 'ALT_BISE_B_OR_50_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Ordis Accountant"),
            'typeline' => clienttranslate("Character - Bureaucrat"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('He has an annoying tendency to overwhelm you with numbers.'),
            'artist' => "Matteo Spirito",
            'extension' => 'WFTM',
            'subtypes'  => [BUREAUCRAT],
            'effectDesc' => clienttranslate('{R} You may spend 1 of my boosts to have target Character gain <ASLEEP>. #You may give it 2 boosts.#'),
            'supportDesc' => clienttranslate('{I} When another Character joins your Expeditions — I gain 1 boost, up to a max of 2.'),
            'supportIcon' => 'infinity',
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 2,
            'costHand' => 2,
            'costReserve' => 3,
            'effectInfinity' => [
                'effectPassive' => [
                    'ChooseAssignment' => [
                        'conditions' => ['isCardAdded:character:::true', 'hasSameOwner'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2),
                    ],
                    'InvokeToken' => [
                        'conditions' => ['isCardAddedAnyPlayer:character:::true', 'hasSameOwner'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2),
                    ],
                    'MoveCard' => [
                        'conditions' => ['isCardAddedAnyPlayer:character:::true', 'hasSameOwner'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2),
                    ],
                ],
            ],
            'effectReserve' => FT::SEQ_OPTIONAL(
                FT::ACTION(SPEND, [
                    'cardId' => ME,
                    'effect' => FT::ACTION(TARGET, ['effect' => FT::SEQ(FT::GAIN(EFFECT, ASLEEP), FT::SEQ_OPTIONAL_MANUAL(FT::GAIN(EFFECT, BOOST, 2)))])
                ])
            ),
        ];
    }
}
