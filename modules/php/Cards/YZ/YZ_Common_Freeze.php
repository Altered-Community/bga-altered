<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_Freeze extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_40_C',
            'asset'  => 'ALT_ALIZE_B_YZ_40_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Freeze"),
            'typeline' => clienttranslate("Spell - Disruption"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('"I\'m putting you on ice!"'),
            'artist' => "HuoMiao Studio",
            'extension' => 'TBF',
            'subtypes'  => [DISRUPTION],
            'effectDesc' => clienttranslate('$<COOLDOWN>.  Send target Character to Reserve, then exhaust it ({T}). (Exhausted cards can\'t be played and have no Support abilities.)'),
            'costHand' => 4,
            'costReserve' => 4,
            'cooldown' => true,
            'effectPlayed' => FT::ACTION(TARGET, [
                'effect' => FT::SEQ(FT::DISCARD_TO_RESERVE(), FT::ACTION(EXHAUST, []))
            ])

        ];
    }
}
