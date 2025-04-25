<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_SapInfusion extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_57_C',
            'asset'  => 'ALT_BISE_B_YZ_57_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Sap Infusion"),
            'typeline' => clienttranslate("Spell - Boon"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('There are a thousand ways to use the Sap. The Yzmir seek to exploit its full potential.'),
            'artist' => "HuoMiao Studio",
            'extension' => 'WFTM',
            'subtypes'  => [BOON],
            'effectDesc' => clienttranslate('Target Character gains X+2 boosts, where X is my number of Arcane counters.'),
            'supportDesc' => clienttranslate('{I} When you play another Spell — I gain 1 Arcane counter, up to a max of 3.'),
            'supportIcon' => 'infinity',
            'costHand' => 2,
            'costReserve' => 3,
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
            'effectPlayed' => FT::ACTION(TARGET, [
                'effect' => FT::GAIN(EFFECT, BOOST, 'sourceCounter2')
            ])
        ];
    }
}
