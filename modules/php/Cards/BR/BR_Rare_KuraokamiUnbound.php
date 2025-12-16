<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_KuraokamiUnbound extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_P_BR_48_R1',
            'asset'  => 'ALT_ALIZE_P_BR_48_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Kuraokami Unbound"),
            'typeline' => clienttranslate("Character - Dragon Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate(''),
            'artist' => "",
            'extension' => 'TBF',
            'subtypes'  => [DRAGON, DEITY],
            'effectDesc' => clienttranslate('{H} Exhaust all cards in Reserve.  #{R} <FLEETING_CHAR> Characters you control gain 2 boosts.#'),
            'forest' => 6,
            'mountain' => 6,
            'ocean' => 6,
            'costHand' => 6,
            'costReserve' => 6,
            'changedStats' => ['forest', 'mountain', 'ocean', 'costReserve'],
            'effectHand' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'exhaustAllCards']),
            'effectReserve' => FT::ACTION(TARGET, ['targetPlayer' => ME, 'statuses' => FLEETING, 'n' => INFTY, 'effect' => FT::GAIN(EFFECT, BOOST, 2)]),
        ];
    }
}
