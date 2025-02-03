<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_Avalanche extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_42_R1',
            'asset'  => 'ALT_ALIZE_B_AX_42_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Avalanche"),
            'typeline' => clienttranslate("Spell - Disruption"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('None of the snowflakes feel personally guilty for the avalanche.'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'TBF',
            'subtypes'  => [DISRUPTION],
            'effectDesc' => clienttranslate('<FLEETING>.  Send to Reserve any number of target Characters with #total {M} of 5 or less#.'),
            'costHand' => 3,
            'costReserve' => 3,
            'effectPlayed' => FT::SEQ(
                FT::GAIN($this, FLEETING),
                FT::ACTION(TARGET, ['upTo' => true, 'n' => INFTY, 'totalMountain' => 5, 'effect' => FT::DISCARD_TO_RESERVE()])
            ),
        ];
    }
}
