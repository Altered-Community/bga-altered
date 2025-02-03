<?php

namespace ALT\Cards\LY;

class LY_Rare_Persephone extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_33_R2',
            'asset'  => 'ALT_ALIZE_B_MU_33_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Persephone"),
            'typeline' => clienttranslate("Character - Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('After every winter must come spring.'),
            'artist' => "Zero Wen",
            'extension' => 'TBF',
            'subtypes'  => [DEITY],
            'effectDesc' => clienttranslate('My region #and the region of the Expedition facing me# are {V} #and lose their other types.#'),
            'forest' => 3,
            'mountain' => 0,
            'ocean' => 0,
            'costHand' => 3,
            'costReserve' => 2,
            'changedStats' => ['costHand'],
            'updateExpeditions' => ['type' => 'sourceAll', 'regionsRemove' => [OCEAN, MOUNTAIN], 'regionsAdd' => [FOREST]],

        ];
    }
}
