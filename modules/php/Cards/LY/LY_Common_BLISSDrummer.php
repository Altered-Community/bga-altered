<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_BLISSDrummer extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_54_C',
            'asset'  => 'ALT_BISE_B_LY_54_C',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("BLISS Drummer"),
            'typeline' => clienttranslate("Character - Artist"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"Throw your hands up in the air for everyone who\'s hauling out those amazing relics from the City of Scholars!" — Tamati'),
            'artist' => "Zero Wen",
            'extension' => 'WFTM',
            'subtypes'  => [ARTIST],
            'effectDesc' => clienttranslate('If I\'m <BOOSTED>, other Characters cost {1} less to play from your Reserve, with a minimum of {1}.'),
            'supportDesc' => clienttranslate('{I} When you play another Character with a base statistic of 0 — I gain 1 boost, up to a max of 2.'),
            'supportIcon' => 'infinity',
            'forest' => 4,
            'mountain' => 4,
            'ocean' => 0,
            'costHand' => 4,
            'costReserve' => 5,
            'effectInfinity' => [
                'effectPassive' => [
                    'ChooseAssignment' => [
                        'conditions' => ['isCardPlayedWithZeroStat', 'excludeSelf'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2)
                    ],
                ]
            ],
            'dynamicReduceReserveCost' => 'myCharacter:hasBoost'
        ];
    }
}
