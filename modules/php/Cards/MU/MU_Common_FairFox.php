<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_FairFox extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_51_C',
            'asset'  => 'ALT_BISE_B_MU_51_C',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Fair Fox"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Should we practice our passing now?'),
            'artist' => "Romain Kurdi",
            'extension' => 'WFTM',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('{H} Target opponent <RESUPPLIES>. (They put the top card of their deck in Reserve.)'),
            'forest' => 3,
            'mountain' => 1,
            'ocean' => 3,
            'costHand' => 2,
            'costReserve' => 2,
            'effectHand' => FT::ACTION(
                TARGET_PLAYER,
                [
                    'effect' => FT::ACTION(RESUPPLY, [])
                ]
            )

        ];
    }
}
