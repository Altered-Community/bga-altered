<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_SaskiaSlyNaturalist extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_35_R1',
            'asset'  => 'ALT_ALIZE_B_MU_35_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Saskia, Sly Naturalist"),
            'typeline' => clienttranslate("Character - Engineer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Parasitic or symbiotic, life will always find a way to blossom... like this algae.'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'TBF',
            'subtypes'  => [ENGINEER],
            'effectDesc' => clienttranslate('{J} Target #any number# of other Characters in {V}. They gain 2 boosts.'),
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 3,
            'costReserve' => 3,
            'changedStats' => ['forest', 'mountain', 'ocean'],
            'effectPlayed' => FT::ACTION(TARGET, ['expeditionAttributes' => [FOREST], 'n' => INFTY, 'upTo' => true, 'excludeSelf' => true, 'effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2])]),

        ];
    }
}
