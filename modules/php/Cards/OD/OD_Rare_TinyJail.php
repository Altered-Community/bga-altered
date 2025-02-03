<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_TinyJail extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_42_R1',
            'asset'  => 'ALT_ALIZE_B_OR_42_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Tiny Jail"),
            'typeline' => clienttranslate("Spell - Disruption"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('Do not collect 200 Florets.'),
            'artist' => "HuoMiao Studio",
            'extension' => 'TBF',
            'subtypes'  => [DISRUPTION],
            'effectDesc' => clienttranslate('#$<COOLDOWN>#.  Send to Reserve target Character with no statistic over 3.'),
            'costHand' => 2,
            'costReserve' => 2,
            'effectPlayed' => FT::ACTION(TARGET, ['maxStatistic' => 3, 'effect' => FT::DISCARD_TO_RESERVE()]),
            'cooldown' => true,
        ];
    }
}
