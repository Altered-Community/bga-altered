<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_ScribblingStarfish extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_49_R2',
            'asset'  => 'ALT_BISE_B_YZ_49_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Scribbling Starfish"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('A good Sigil starts with a good sketch.'),
            'artist' => "Zero Wen",
            'extension' => 'WFTM',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('#{R} You may spend 1 of my boosts to draw a card.#'),
            'supportDesc' => clienttranslate('{I} #When you play another Character with a base statistic of 0# — I gain 1 boost, up to a max of 2.'),
            'supportIcon' => 'infinity',
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 0,
            'costHand' => 1,
            'costReserve' => 2,
            'changedStats' => ['ocean'],
            'effectInfinity' => [
                'effectPassive' => [
                    'ChooseAssignment' => [
                        'conditions' => ['isCardPlayedWithZeroStat', 'excludeSelf'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2)
                    ],
                ]
            ],
            'effectReserve' => FT::SEQ_OPTIONAL(
                FT::ACTION(SPEND, ['cardId' => ME, 'effect' => FT::ACTION(DRAW, ['players' => ME])])
            ),
        ];
    }
}
