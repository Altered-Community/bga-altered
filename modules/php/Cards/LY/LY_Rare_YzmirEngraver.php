<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_YzmirEngraver extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_50_R2',
            'asset'  => 'ALT_BISE_B_YZ_50_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Yzmir Engraver"),
            'typeline' => clienttranslate("Character - Artist Mage"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('By mixing Sap into the ink, the power of the Sigils is augmented tenfold.'),
            'artist' => "Zero Wen",
            'extension' => 'WFTM',
            'subtypes'  => [ARTIST, MAGE],
            'effectDesc' => clienttranslate('{R} You may spend 1 of my boosts to #discard target Character or Permanent# with Hand Cost {2} or less.'),
            'supportDesc' => clienttranslate('{I} #When you play another Character with a base statistic of 0# — I gain 1 boost, up to a max of 2.'),
            'supportIcon' => 'infinity',
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 0,
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
            'effectReserve' => FT::SEQ_OPTIONAL(
                FT::ACTION(SPEND, [
                    'cardId' => ME,
                    'effect' =>  FT::ACTION(TARGET, [
                        'targetType' => [CHARACTER, TOKEN, PERMANENT],
                        'maxHandCost' => 2,
                        'effect' => FT::ACTION(DISCARD, []),
                    ])
                ])
            ),
        ];
    }
}
