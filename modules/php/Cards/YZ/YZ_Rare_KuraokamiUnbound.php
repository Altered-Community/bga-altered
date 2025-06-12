<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_KuraokamiUnbound extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_P_OR_48_R2',
            'asset'  => 'ALT_ALIZE_P_OR_48_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Kuraokami Unbound"),
            'typeline' => clienttranslate("Character - Dragon Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate(''),
            'artist' => "",
            'extension' => 'TBF',
            'subtypes'  => [DRAGON, DEITY],
            'effectDesc' => clienttranslate('{H} #Target opponent puts a card from their hand in Reserve. Then,# exhaust all cards in Reserve.'),
            'forest' => 5,
            'mountain' => 5,
            'ocean' => 5,
            'costHand' => 7,
            'costReserve' => 5,
            'changedStats' => ['costHand'],
            'effectHand' => FT::SEQ(
                FT::ACTION(
                    TARGET_PLAYER,
                    ['effect' => FT::ACTION(
                        TARGET,
                        [
                            'targetType' => [CHARACTER, SPELL, PERMANENT],
                            'targetPlayer' => ME,
                            'targetLocation' => [HAND],
                            'effect' => FT::DISCARD_TO_RESERVE(),
                        ],
                    )]
                ),
                FT::ACTION(SPECIAL_EFFECT, ['effect' => 'exhaustAllCards']),
            )
        ];
    }
}
