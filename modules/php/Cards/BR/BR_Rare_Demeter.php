<?php

namespace ALT\Cards\BR;

class BR_Rare_Demeter extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_40_R2',
            'asset'  => 'ALT_ALIZE_B_MU_40_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Demeter"),
            'typeline' => clienttranslate("Character - Plant Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Hope springs eternal.'),
            'artist' => "Zero Wen",
            'extension' => 'TBF',
            'subtypes'  => [PLANT, DEITY],
            'effectDesc' => clienttranslate('If I\'m in {V}, I am $<ETERNAL_FS>.'),
            'forest' => 6,
            'mountain' => 5,
            'ocean' => 5,
            'costHand' => 6,
            'costReserve' => 6,
            'dynamicEternal' => '1:isInBiome:forest'
        ];
    }
}
