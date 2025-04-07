<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_Lakshmi extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_55_R2',
            'asset'  => 'ALT_BISE_B_LY_55_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Lakshmi"),
            'typeline' => clienttranslate("Character - Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Fortune smiles on those who give themselves over to it.'),
            'artist' => "Taras Susak",
            'extension' => 'WFTM',
            'subtypes'  => [DEITY],
            'effectDesc' => clienttranslate('When you #sacrifice a Character# — I gain 1 boost.'),
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 3,
            'costReserve' => 3,
            'changedStats' => ['forest', 'mountain', 'ocean'],
            'effectPassive' => [
                'Discard' => [
                    'conditions' => ['isMe', 'isSacrifice:character'],
                    'output' => FT::GAIN(ME, BOOST),
                ],
            ],
        ];
    }
}
