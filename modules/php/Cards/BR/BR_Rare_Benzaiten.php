<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Benzaiten extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_46_R2',
            'asset'  => 'ALT_ALIZE_B_OR_46_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Benzaiten"),
            'typeline' => clienttranslate("Character - Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Good things come to those who wait.'),
            'artist' => "Zero Wen",
            'extension' => 'TBF',
            'subtypes'  => [DEITY],
            'effectDesc' => clienttranslate('{J} If my Expedition is behind, draw a card.'),
            'forest' => 6,
            'mountain' => 6,
            'ocean' => 6,
            'costHand' => 6,
            'costReserve' => 6,
            'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'myExpeditionIsBehind', 'effect' => FT::ACTION(DRAW, ['players' => ME])])

        ];
    }
}
