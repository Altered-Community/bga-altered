<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Benzaiten extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_46_R1',
            'asset'  => 'ALT_ALIZE_B_OR_46_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Benzaiten"),
            'typeline' => clienttranslate("Character - Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Good things come to those who wait.'),
            'artist' => "Zero Wen",
            'extension' => 'TBF',
            'subtypes'  => [DEITY],
            'effectDesc' => clienttranslate('{J} If my Expedition is behind, draw a card. #Otherwise, <RESUPPLY_LOW>.#'),
            'forest' => 6,
            'mountain' => 6,
            'ocean' => 6,
            'costHand' => 6,
            'costReserve' => 6,
            'effectPlayed' => FT::XOR(
                FT::ACTION(CHECK_CONDITION, ['condition' => 'myExpeditionIsBehind', 'description' => clienttranslate('Expedition is behind'), 'effect' => FT::ACTION(DRAW, ['players' => ME])]),
                FT::ACTION(CHECK_CONDITION, ['condition' => 'myExpeditionIsNotBehind', 'description' => clienttranslate('Expedition is not behind'), 'effect' => FT::ACTION(RESUPPLY, [])]),
            )

        ];
    }
}
