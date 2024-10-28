<?php

namespace ALT\Cards\OD;

class OD_Rare_Vishvakarma extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_39_R2',
            'asset'  => 'ALT_ALIZE_B_AX_39_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Vishvakarma"),
            'typeline' => clienttranslate("Character - Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Each construction is a poem, and building is an act of eloquence.'),
            'artist' => "Taras Susak",
            'extension' => 'TBF',
            'subtypes'  => [DEITY],
            'effectDesc' => clienttranslate('{J} The next Permanent you play this Afternoon costs #{3} less#.'),
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 2,
            'costHand' => 4,
            'costReserve' => 4,
            'changedStats' => ['forest', 'mountain', 'ocean', 'costHand', 'costReserve'],
            'effectPlayed' => [
                'action' => SPECIAL_EFFECT,
                'args' => ['effect' => 'costReduction', 'args' => ['type' => PERMANENT, 'reduction' => 3, 'permanent' => true]],
            ],
        ];
    }
}
