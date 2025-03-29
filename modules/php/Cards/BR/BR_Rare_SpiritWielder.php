<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_SpiritWielder extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_50_R1',
            'asset'  => 'ALT_BISE_B_BR_50_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Spirit Wielder"),
            'typeline' => clienttranslate("Character - Adventurer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Memories of a forgotten civilization linger in those ruins. We are not alone.'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'WFTM',
            'subtypes'  => [ADVENTURER],
            'effectDesc' => clienttranslate('{J} I gain 1 boost per <BOOSTED> Character you control.  #{R} I gain 1 boost.#'),
            'forest' => 1,
            'mountain' => 2,
            'ocean' => 1,
            'costHand' => 2,
            'costReserve' => 3,
            'changedStats' => ['mountain', 'costReserve'],
            'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXBoostedChar']),
            'effectReserve' => FT::GAIN(ME, BOOST)
        ];
    }
}
