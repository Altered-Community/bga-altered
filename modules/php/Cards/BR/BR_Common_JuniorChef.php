<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_JuniorChef extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_49_C',
            'asset'  => 'ALT_BISE_B_BR_49_C',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Junior Chef"),
            'typeline' => clienttranslate("Character - Animal Apprentice"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('The Bravos are always the best with a blade, whether it\'s in a duel or in the kitchen.'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'WFTM',
            'subtypes'  => [ANIMAL, APPRENTICE],
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
            ]
        ];
    }
}
