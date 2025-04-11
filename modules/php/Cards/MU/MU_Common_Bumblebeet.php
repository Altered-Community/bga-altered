<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Bumblebeet extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_50_C',
            'asset'  => 'ALT_BISE_B_MU_50_C',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Bumblebeet"),
            'typeline' => clienttranslate("Character - Plant Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('On the surface, pollination by bumblebeets is a key tool in growing Muna crops.'),
            'artist' => "Ba Vo",
            'extension' => 'WFTM',
            'subtypes'  => [PLANT, ANIMAL],
            'supportDesc' => clienttranslate('{I} At Noon — I gain 1 boost, up to a max of 2.'),
            'supportIcon' => 'infinity',
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 1,
            'costReserve' => 2,
            'effectInfinity' => [
                'effectPassive' => [
                    'Noon' => [
                        'condition' => 'isMe',
                        'output' => FT::GAIN(ME, BOOST, 1, 2)
                    ],
                ],
            ]
        ];
    }
}
