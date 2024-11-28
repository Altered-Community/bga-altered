<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_KuraokamiUnbound extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_P_MU_48_R1',
            'asset'  => 'ALT_ALIZE_P_MU_48_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Kuraokami Unbound"),
            'typeline' => clienttranslate("Character - Dragon Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate(''),
            'artist' => "",
            'extension' => 'TBF',
            'subtypes'  => [DRAGON, DEITY],
            'effectDesc' => clienttranslate('{H} Exhaust all cards in Reserve.  #{J} I gain <ANCHORED>.#'),
            'forest' => 5,
            'mountain' => 5,
            'ocean' => 5,
            'costHand' => 7,
            'costReserve' => 7,
            'changedStats' => ['costHand', 'costReserve'],
            'effectHand' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'exhaustAllCards']),
            'effectPlayed' => FT::GAIN(ME, ANCHORED),
        ];
    }
}
