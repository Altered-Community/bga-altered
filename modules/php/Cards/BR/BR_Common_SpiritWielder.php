<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_SpiritWielder extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_50_C',
            'asset'  => 'ALT_BISE_B_BR_50_C',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Spirit Wielder"),
            'typeline' => clienttranslate("Character - Adventurer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Memories of a forgotten civilization linger in those ruins. We are not alone.'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'WFTM',
            'subtypes'  => [ADVENTURER],
            'effectDesc' => clienttranslate('{J} I gain 1 boost per <BOOSTED> Character you control. (Cards in Reserve are not controlled.)'),
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 2,
            'costReserve' => 2,
            'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXBoostedChar']),
        ];
    }
}
