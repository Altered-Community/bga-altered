<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_BLISSKeytarist extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_52_C',
            'asset'  => 'ALT_BISE_B_LY_52_C',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("BLISS Keytarist"),
            'typeline' => clienttranslate("Character - Artist"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"Make some noise for all the brave folks pulling Sap up from the depths!" — Orbec'),
            'artist' => "Zero Wen",
            'extension' => 'WFTM',
            'subtypes'  => [ARTIST],
            'effectDesc' => clienttranslate('At Dusk — If I\'m <BOOSTED>, reveal the top card of your deck. If it\'s a Character with a base statistic of 0, draw it. Otherwise, discard it.'),
            'supportDesc' => clienttranslate('{I} When you play another Character with a base statistic of 0 — I gain 1 boost, up to a max of 2.'),
            'supportIcon' => 'infinity',
            'forest' => 2,
            'mountain' => 0,
            'ocean' => 2,
            'costHand' => 2,
            'costReserve' => 3,
            'effectInfinity' => [
                'effectPassive' => [
                    'ChooseAssignment' => [
                        'conditions' => ['isCardPlayedWithZeroStat', 'excludeSelf'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2)
                    ],
                ]
            ],
            'effectPassive' => [
                'BeforeDusk' => [
                    'conditions' => ['isMe'],
                    'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostedRevealBaseStat'])
                ]
            ]
        ];
    }
}
