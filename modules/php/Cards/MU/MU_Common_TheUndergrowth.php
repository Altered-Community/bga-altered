<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_TheUndergrowth extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_63_C',
            'asset'  => 'ALT_BISE_B_MU_63_C',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("The Undergrowth"),
            'typeline' => clienttranslate("Landmark_permanent - Site"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Nature always reclaims its rights.'),
            'artist' => "Ba Vo",
            'extension' => 'WFTM',
            'subtypes'  => [SITE, LANDMARK],
            'effectDesc' => clienttranslate('{T} : The next Character you play in {V} this turn gains 1 boost.'),
            'costHand' => 2,
            'costReserve' => 2,
            'effectTap' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterVGainsBoost'])

        ];
    }
}
