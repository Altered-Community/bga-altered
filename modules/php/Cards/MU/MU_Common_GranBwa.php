<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_GranBwa extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_56_C',
            'asset'  => 'ALT_BISE_B_MU_56_C',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Gran Bwa"),
            'typeline' => clienttranslate("Character - Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Make an offering of Sap and spiced rum, and Gran Bwa will bless your orchard.'),
            'artist' => "Ba Vo",
            'extension' => 'WFTM',
            'subtypes'  => [DEITY],
            'effectDesc' => clienttranslate('{J} You may have target opponent draw a card. If you do, I gain $<ANCHORED>.'),
            'supportDesc' => clienttranslate('{I} At Noon — I gain 1 boost, up to a max of 2.'),
            'supportIcon' => 'infinity',
            'forest' => 4,
            'mountain' => 4,
            'ocean' => 4,
            'costHand' => 4,
            'costReserve' => 5,
            'effectInfinity' => [
                'effectPassive' => [
                    'Noon' => [
                        'condition' => 'isMe',
                        'output' => FT::GAIN(ME, BOOST, 1, 2)
                    ],
                ],
            ],
            'effectPlayed' => FT::SEQ_OPTIONAL_MANUAL(
                FT::ACTION(TARGET_PLAYER, ['opponentsOnly' => true, 'effect' => FT::ACTION(DRAW, ['players' => ME])]),
                FT::GAIN(ME, ANCHORED)
            )
        ];
    }
}
