<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Akhlut extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_38_R1',
            'asset'  => 'ALT_ALIZE_B_BR_38_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Akhlut"),
            'typeline' => clienttranslate("Character - Animal Spirit"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('They\'re deadly on land, and even deadlier in the water.'),
            'artist' => "Matteo Spirito",
            'extension' => 'TBF',
            'subtypes'  => [ANIMAL, SPIRIT],
            'effectDesc' => clienttranslate('When I gain 1 or more boosts — You may exhaust ({T}) target card in Reserve. (Exhausted cards can\'t be played and have no Support abilities.)  #{J}# I gain 1 boost.'),
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 4,
            'costHand' => 4,
            'costReserve' => 4,
            'changedStats' => ['ocean', 'costReserve'],
            'effectPassive' => [
                'Gain' => [
                    'condition' => 'hasGained:boost',
                    'output' =>  FT::ACTION(TARGET, [
                        'targetType' => [CHARACTER, SPELL, PERMANENT],
                        'targetLocation' => [RESERVE],
                        'upTo' => true,
                        'effect' => FT::ACTION(EXHAUST, [])
                    ]),
                ],
            ],
            'effectPlayed' => FT::GAIN(ME, BOOST),
        ];
    }
}
