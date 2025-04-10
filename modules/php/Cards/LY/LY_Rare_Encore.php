<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_Encore extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_59_R1',
            'asset'  => 'ALT_BISE_B_LY_59_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Encore"),
            'typeline' => clienttranslate("Spell - Song"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('Ready for more?'),
            'artist' => "Justice Wong",
            'extension' => 'WFTM',
            'subtypes'  => [SONG],
            'effectDesc' => clienttranslate('#<FLEETING>.#  Target <FLEETING_CHAR> #or <BOOSTED># Character gains <ANCHORED>. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)'),
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['costReserve'],
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::ACTION(TARGET, [
                    'statuses' => [FLEETING, BOOST],
                    'targetType' => [CHARACTER, TOKEN],
                    'effect' => FT::GAIN(EFFECT, ANCHORED),
                ])
            )
        ];
    }
}
