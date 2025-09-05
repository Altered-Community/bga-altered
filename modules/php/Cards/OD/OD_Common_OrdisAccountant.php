<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_OrdisAccountant extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_50_C',
            'asset'  => 'ALT_BISE_B_OR_50_C',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Ordis Accountant"),
            'typeline' => clienttranslate("Character - Bureaucrat"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('He has an annoying tendency to overwhelm you with numbers.'),
            'artist' => "Matteo Spirito",
            'extension' => 'WFTM',
            'subtypes'  => [BUREAUCRAT],
            'effectDesc' => clienttranslate('{R} You may spend 1 of my boosts to have target Character gain <ASLEEP>. (During Dusk, ignore its statistics. During Rest, it doesn\'t go to Reserve and it loses Asleep.)'),
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
                        'conditions' => ['isCardAdded:character:::true', 'hasSameOwner'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2),
                    ],
                    'MoveCard' => [
                        'conditions' => ['isCardAdded:character:::true', 'hasSameOwner'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2),
                    ],
                ],
            ],
            'effectReserve' => FT::SEQ_OPTIONAL(
                FT::ACTION(SPEND, [
                    'cardId' => ME,
                    'effect' => FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, ASLEEP)])
                ])
            ),
        ];
    }
}
