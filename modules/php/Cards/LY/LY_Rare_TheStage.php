<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_TheStage extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_63_R1',
            'asset'  => 'ALT_BISE_B_LY_63_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("The Stage"),
            'typeline' => clienttranslate("Landmark Permanent - Construction"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Day or night, the music of BLISS reinvigorates weary hearts and bodies.'),
            'artist' => "Zero Wen",
            'extension' => 'WFTM',
            'subtypes'  => [CONSTRUCTION, LANDMARK],
            'effectDesc' => clienttranslate('When you play a #Song# or #Artist# — I gain 1 Performance counter.  {T}, Spend 3 of my Performance counters: the next #Song# or #Artist# you play this turn loses <FLEETING>.'),
            'costHand' => 2,
            'costReserve' => 2,
            'effectPassive' => [
                'ChooseAssignment' => [
                    'childs' => [
                        [
                            'conditions' => ['isCardPlayed:song', 'excludeSelf'],
                            'output' => FT::ACTION(SPECIAL_EFFECT, [
                                'effect' => 'incCounter',
                                'args' => ['counter' => 1, 'counterName' => clienttranslate('Performance counter')],
                            ]),
                        ],
                        [
                            'conditions' => ['isCardPlayed:artist', 'excludeSelf'],
                            'output' => FT::ACTION(SPECIAL_EFFECT, [
                                'effect' => 'incCounter',
                                'args' => ['counter' => 1, 'counterName' => clienttranslate('Performance counter')],
                            ]),
                        ],
                    ]
                ]
            ],
            'effectTap' => FT::ACTION(CHECK_CONDITION, [
                'condition' => 'hasCounterOnCard:3',
                'effect' => FT::SEQ(
                    FT::ACTION(USE_COUNTER, ['consume' => 3]),
                    FT::ACTION(SPECIAL_EFFECT, ['effect' => 'removeFleetingSongArtistPlayed'])
                )
            ], ['sourceId' => $this->id]), // VERY Important!!

        ];
    }
}
