<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_Demeter extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_40_R1',
            'asset'  => 'ALT_ALIZE_B_MU_40_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Demeter"),
            'typeline' => clienttranslate("Character - Plant Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Hope springs eternal.'),
            'artist' => "Zero Wen",
            'extension' => 'TBF',
            'subtypes'  => [PLANT, DEITY],
            'effectDesc' => clienttranslate('#{J} Target Character gains <ANCHORED>.#  If I\'m in {V}, I am $<ETERNAL_FS>.'),
            'forest' => 6,
            'mountain' => 5,
            'ocean' => 5,
            'costHand' => 7,
            'costReserve' => 7,
            'changedStats' => ['costHand', 'costReserve'],
            'dynamicEternal' => '1:isInBiome:forest:true',
            'effectPlayed' => FT::ACTION(TARGET, ['effect' => FT::GAIN($this, ANCHORED)]),
        ];
    }
}
