<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_SilentNight extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_41_C',
            'asset'  => 'ALT_ALIZE_B_LY_41_C',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Silent Night"),
            'typeline' => clienttranslate("Spell - Song"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('All is calm, all is bright.'),
            'artist' => "Romain Kurdi",
            'extension' => 'TBF',
            'subtypes'  => [SONG],
            'effectDesc' => clienttranslate('<FLEETING>.  Target a Character, then roll a die. On a:  • 4+, it gains <ANCHORED>. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)  • 1-3, it gains <ASLEEP>. (Ignore its statistics during Dusk. During Rest, it doesn\'t go to Reserve and it loses Asleep.)'),
            'costHand' => 1,
            'costReserve' => 1,
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::ACTION(TARGET, [
                    'effect' => FT::ACTION(ROLL_DIE, [
                        'effect' => [
                            '1-3' => FT::GAIN(EFFECT, ASLEEP),
                            '4+' => FT::GAIN(EFFECT, ANCHORED),
                        ],
                    ]),
                ]),
            )
        ];
    }
}
