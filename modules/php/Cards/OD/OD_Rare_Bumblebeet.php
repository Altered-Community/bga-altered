<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Bumblebeet extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_50_R2',
            'asset'  => 'ALT_BISE_B_MU_50_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Bumblebeet"),
            'typeline' => clienttranslate("Character - Plant Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('On the surface, pollination by bumblebeets is a key tool in growing Muna crops.'),
            'artist' => "Ba Vo",
            'extension' => 'WFTM',
            'subtypes'  => [PLANT, ANIMAL],
            'effectDesc' => clienttranslate('#{R} I gain <ANCHORED>.#'),
            'supportDesc' => clienttranslate('{I} #When another Character joins your Expeditions# — I gain 1 boost, up to a max of 2.'),
            'supportIcon' => 'infinity',
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 1,
            'costReserve' => 3,
            'changedStats' => ['costReserve'],
            'effectInfinity' => [
                'effectPassive' => [
                    'ChooseAssignment' => [
                        'conditions' => ['isCardAdded:character:::true'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2),
                    ],
                    'InvokeToken' => [
                        'conditions' => ['isCardAddedAnyPlayer:character:::true'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2),
                    ],
                    'MoveCard' => [
                        'conditions' => ['isCardAddedAnyPlayer:character:::true', 'hasSameOwner'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2),
                    ],
                ],
            ],
            'effectReserve' => FT::GAIN(ME, ANCHORED)
        ];
    }
}
