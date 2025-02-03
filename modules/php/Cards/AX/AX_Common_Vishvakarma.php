<?php

namespace ALT\Cards\AX;

class AX_Common_Vishvakarma extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_39_C',
            'asset'  => 'ALT_ALIZE_B_AX_39_C',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Vishvakarma"),
            'typeline' => clienttranslate("Character - Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Each construction is a poem, and building is an act of eloquence.'),
            'artist' => "Taras Susak",
            'extension' => 'TBF',
            'subtypes'  => [DEITY],
            'effectDesc' => clienttranslate('{J} The next Permanent you play this Afternoon costs {4} less.'),
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 5,
            'costReserve' => 5,
            'effectPlayed' => [
                'action' => SPECIAL_EFFECT,
                'args' => ['effect' => 'costReduction', 'args' => ['type' => PERMANENT, 'reduction' => 4, 'permanent' => true]],
            ],

        ];
    }
}
