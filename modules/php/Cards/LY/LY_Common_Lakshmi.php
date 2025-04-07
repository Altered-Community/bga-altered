<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_Lakshmi extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_55_C',
            'asset'  => 'ALT_BISE_B_LY_55_C',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Lakshmi"),
            'typeline' => clienttranslate("Character - Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Fortune smiles on those who give themselves over to it.'),
            'artist' => "Taras Susak",
            'extension' => 'WFTM',
            'subtypes'  => [DEITY],
            'effectDesc' => clienttranslate('When you roll one or more dice — I gain 1 boost.'),
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 2,
            'costHand' => 3,
            'costReserve' => 3,
            'effectPassive' => [
                'RollDie' => [
                    'condition' => 'isMe',
                    'output' => FT::GAIN(ME, BOOST)
                ]
            ]
        ];
    }
}
