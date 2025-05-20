<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_OrdisCrier extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_49_C',
            'asset'  => 'ALT_BISE_B_OR_49_C',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Ordis Crier"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('He\'s surprisingly happy for someone who cries all day.'),
            'artist' => "Matteo Spirito",
            'extension' => 'WFTM',
            'subtypes'  => [ANIMAL],
            'supportDesc' => clienttranslate('{I} When another Character joins your Expeditions — I gain 1 boost, up to a max of 2.'),
            'supportIcon' => 'infinity',
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 0,
            'costHand' => 1,
            'costReserve' => 2,
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
            ],
        ];
    }
}
