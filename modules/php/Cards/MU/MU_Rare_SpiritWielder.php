<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_SpiritWielder extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_50_R2',
            'asset'  => 'ALT_BISE_B_BR_50_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Spirit Wielder"),
            'typeline' => clienttranslate("Character - Adventurer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Memories of a forgotten civilization linger in those ruins. We are not alone.'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'WFTM',
            'subtypes'  => [ADVENTURER],
            'effectDesc' => clienttranslate('{J} I gain 1 boost per #<ANCHORED># Character you control.  #{R} I gain $<ANCHORED>.#'),
            'forest' => 1,
            'mountain' => 2,
            'ocean' => 1,
            'costHand' => 2,
            'costReserve' => 3,
            'changedStats' => ['mountain', 'costReserve'],
            'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXAnchoredChar']),
            'effectReserve' => FT::GAIN(ME, ANCHORED)
        ];
    }
}
