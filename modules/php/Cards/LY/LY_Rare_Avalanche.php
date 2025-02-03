<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_Avalanche extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_42_R2',
            'asset'  => 'ALT_ALIZE_B_AX_42_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Avalanche"),
            'typeline' => clienttranslate("Spell - Disruption"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('None of the snowflakes feel personally guilty for the avalanche.'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'TBF',
            'subtypes'  => [DISRUPTION],
            'effectDesc' => clienttranslate('<FLEETING>.  Send to Reserve any number of target Characters with total {M} of 4 or less.'),
            'costHand' => 3,
            'costReserve' => 3,
            'effectPlayed' => FT::SEQ(
                FT::GAIN($this, FLEETING),
                FT::ACTION(TARGET, ['upTo' => true, 'n' => INFTY, 'totalMountain' => 4, 'effect' => FT::DISCARD_TO_RESERVE()])
            ),
        ];
    }
}
