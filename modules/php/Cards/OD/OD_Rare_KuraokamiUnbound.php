<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_KuraokamiUnbound extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_P_OR_48_R1',
            'asset'  => 'ALT_ALIZE_P_OR_48_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Kuraokami Unbound"),
            'typeline' => clienttranslate("Character - Dragon Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate(''),
            'artist' => "",
            'extension' => 'TBF',
            'subtypes'  => [DRAGON, DEITY],
            'effectDesc' => clienttranslate('{H} Exhaust all cards in Reserve. #Then, target an Expedition that\'s ahead. Each of its Characters gain <ASLEEP>.#'),
            'forest' => 5,
            'mountain' => 5,
            'ocean' => 5,
            'costHand' => 6,
            'costReserve' => 5,
            'effectHand' => FT::SEQ(
                FT::ACTION(SPECIAL_EFFECT, ['effect' => 'exhaustAllCards']),
                FT::ACTION(TARGET_EXPEDITION, ['type' => 'ahead', 'effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'sleepingAllCharactersinExpedition'])])
            )
        ];
    }
}
