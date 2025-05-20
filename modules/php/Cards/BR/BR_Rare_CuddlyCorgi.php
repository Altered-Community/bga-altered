<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_CuddlyCorgi extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_52_R2',
            'asset'  => 'ALT_BISE_B_MU_52_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Cuddly Corgi"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('She hunts mercilessly for treats and snuggles.'),
            'artist' => "Zael",
            'extension' => 'WFTM',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('When a Character you control gains #<FLEETING># — I gain 1 boost.'),
            'forest' => 2,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 2,
            'costReserve' => 2,
            'effectPassive' => [
                'Gain' => [
                    'conditions' => ['hasGainedFleeting'],
                    'output' => FT::GAIN(ME, BOOST)
                ],
            ]
        ];
    }
}
