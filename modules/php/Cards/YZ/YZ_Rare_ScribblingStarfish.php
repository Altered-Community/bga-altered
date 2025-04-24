<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_ScribblingStarfish extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_49_R1',
            'asset'  => 'ALT_BISE_B_YZ_49_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Scribbling Starfish"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('A good Sigil starts with a good sketch.'),
            'artist' => "Zero Wen",
            'extension' => 'WFTM',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('#{R} You may spend 1 of my boosts to draw a card.#'),
            'supportDesc' => clienttranslate('{I} When you play a Spell — I gain 1 boost, up to a max of 2.'),
            'supportIcon' => 'infinity',
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 1,
            'costReserve' => 2,
            'effectInfinity' => [
                'effectPassive' => [
                    'ChooseAssignment' => [
                        'conditions' => ['isCardPlayed:spell', 'excludeSelf'],
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
