<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_SilentNight extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_41_R2',
            'asset'  => 'ALT_ALIZE_B_LY_41_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Silent Night"),
            'typeline' => clienttranslate("Spell - Song"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('All is calm, all is bright.'),
            'artist' => "Romain Kurdi",
            'extension' => 'TBF',
            'subtypes'  => [SONG],
            'effectDesc' => clienttranslate('<FLEETING>.  #Roll a die, then# target a Character. On a:  • 4+, it gains <ANCHORED>. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)  • 1-3, it gains <ASLEEP>. (Ignore its statistics during Dusk. During Rest, it doesn\'t go to Reserve and it loses Asleep.)'),
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['costHand'],
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::ACTION(ROLL_DIE, [
                    'effect' => [
                        '1-3' =>  FT::ACTION(TARGET, [
                            'effect' => FT::GAIN(EFFECT, ASLEEP),
                        ]),
                        '4+' =>  FT::ACTION(TARGET, [
                            'effect' => FT::GAIN(EFFECT, ANCHORED),
                        ])
                    ],
                ]),
            )
        ];
    }
}
