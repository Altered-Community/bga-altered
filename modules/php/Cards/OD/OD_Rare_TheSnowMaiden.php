<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_TheSnowMaiden extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_39_R2',
            'asset'  => 'ALT_ALIZE_B_MU_39_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("The Snow Maiden"),
            'typeline' => clienttranslate("Character - Elemental"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Thus, as the snow falls under the sky\'s clear frost. She has awoken - Snegurochka is once again!'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'TBF',
            'subtypes'  => [ELEMENTAL],
            'effectDesc' => clienttranslate('{H} Target opponent may <EXHAUSTED_RESUPPLY_INF>. (They put the top card of their deck in Reserve, then exhaust it {T}.)'),
            'forest' => 5,
            'mountain' => 5,
            'ocean' => 5,
            'costHand' => 4,
            'costReserve' => 4,
            'effectHand' => FT::ACTION(TARGET_PLAYER, ['opponentsOnly' => true, 'effect' => FT::SEQ_OPTIONAL(FT::ACTION(RESUPPLY, ['exhausted' => true]))])

        ];
    }
}
