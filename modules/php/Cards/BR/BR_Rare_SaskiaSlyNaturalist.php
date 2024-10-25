<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_SaskiaSlyNaturalist extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_35_R2',
            'asset'  => 'ALT_ALIZE_B_MU_35_R2',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Saskia, Sly Naturalist"),
            'typeline' => clienttranslate("Character - Engineer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Parasitic or symbiotic, life will always find a way to blossom... like this algae.'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'TBF',
            'subtypes'  => [ENGINEER],
            'effectDesc' => clienttranslate('{J} You may target another Character in {V}. It gains 2 boosts.'),
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 2,
            'costHand' => 3,
            'costReserve' => 3,
            'effectPlayed' => FT::ACTION(TARGET, ['expeditionAttributes' => [FOREST], 'upTo' => true, 'excludeSelf' => true, 'effect' => FT::ACTION(GAIN, ['type' => BOOST, 'n' => 2])]),
        ];
    }
}
