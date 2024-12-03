<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_TheSnowMaiden extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_39_R1',
            'asset'  => 'ALT_ALIZE_B_MU_39_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("The Snow Maiden"),
            'typeline' => clienttranslate("Character - Elemental"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Thus, as the snow falls under the sky\'s clear frost. She has awoken - Snegurochka is once again!'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'TBF',
            'subtypes'  => [ELEMENTAL],
            'effectDesc' => clienttranslate('{H} Target opponent may <EXHAUSTED_RESUPPLY_INF> #twice#. (They put the top card of their deck in Reserve, then exhaust it {T}.)'),
            'forest' => 6,
            'mountain' => 6,
            'ocean' => 6,
            'costHand' => 4,
            'costReserve' => 5,
            'changedStats' => ['forest', 'mountain', 'ocean', 'costReserve'],
            'effectHand' => FT::ACTION(TARGET_PLAYER, ['opponentsOnly' => true, 'effect' => FT::SEQ_OPTIONAL(
                FT::ACTION(RESUPPLY, ['exhausted' => true], ['pId' => 'active']),
                FT::ACTION(RESUPPLY, ['exhausted' => true], ['pId' => 'active'])
            )])
        ];
    }
}
