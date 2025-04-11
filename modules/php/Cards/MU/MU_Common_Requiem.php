<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Requiem extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_60_C',
            'asset'  => 'ALT_BISE_B_MU_60_C',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Requiem"),
            'typeline' => clienttranslate("Spell - Disruption Song"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('Preserving harmony. Maintaining balance. Sometimes one thing must die so that another may live.'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'WFTM',
            'subtypes'  => [DISRUPTION, SONG],
            'effectDesc' => clienttranslate('$<FLEETING>.  Choose one:  • Discard target <FLEETING> Character with Hand Cost {4} or less.  • Discard target Permanent with Hand Cost {4} or less.'),
            'costHand' => 2,
            'costReserve' => 2,
            'effectPlayed' => FT::XOR(
                FT::ACTION(TARGET, [
                    'targetType' => [CHARACTER, TOKEN],
                    'maxHandCost' => 4,
                    'statuses' => [FLEETING],
                    'effect' => FT::ACTION(DISCARD, []),
                ]),
                FT::ACTION(TARGET, [
                    'targetType' => [PERMANENT],
                    'maxHandCost' => 4,
                    'effect' => FT::ACTION(DISCARD, []),
                ])
            )
        ];
    }
}
