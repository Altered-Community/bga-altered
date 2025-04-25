<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_SapInfusion extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_57_R1',
            'asset'  => 'ALT_BISE_B_YZ_57_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Sap Infusion"),
            'typeline' => clienttranslate("Spell - Boon"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('There are a thousand ways to use the Sap. The Yzmir seek to exploit its full potential.'),
            'artist' => "HuoMiao Studio",
            'extension' => 'WFTM',
            'subtypes'  => [BOON],
            'effectDesc' => clienttranslate('#Do the following X+1 times,# where X is my number of Arcane counters:  • Target Character gains #1 boost.#'),
            'supportDesc' => clienttranslate('{I} When you play another Spell — I gain 1 Arcane counter, up to a max of 3.'),
            'supportIcon' => 'infinity',
            'costHand' => 1,
            'costReserve' => 3,
            'changedStats' => ['costHand'],
            'effectInfinity' => [
                'effectPassive' => [
                    'ChooseAssignment' => [
                        'conditions' => ['isCardPlayed:spell', 'excludeSelf'],
                        'output' => FT::ACTION(SPECIAL_EFFECT, [
                            'effect' => 'incCounter',
                            'args' => ['counter' => 1, 'counterName' => clienttranslate('Arcane counter'), 'maxCounter' => 3]
                        ])
                    ],
                ]
            ],
            'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, [
                'effect' => 'doCounter1',
                'args' => [
                    'effect' => FT::ACTION(TARGET, ['effect' => FT::ACTION(GAIN, ['type' => BOOST])])
                ]
            ])
        ];
    }
}
