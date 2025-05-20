<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_NilamSpires extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_62_C',
            'asset'  => 'ALT_BISE_B_YZ_62_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Nilam Spires"),
            'typeline' => clienttranslate("Landmark Permanent - Construction"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Observing the Tumult requires taking a high-level perspective on it, and mastering it requires knowledge.'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'WFTM',
            'subtypes'  => [CONSTRUCTION, LANDMARK],
            'effectDesc' => clienttranslate('When you play a Spell — I gain 1 Arcane counter. Then, you may exhaust me ({T}) and spend 4 of my Arcane counters to create a <MANA_MOTH> Illusion token in target Expedition.'),
            'costHand' => 2,
            'costReserve' => 2,
            'effectPassive' => [
                'ChooseAssignment' => [
                    'condition' => 'isCardPlayed:spell',
                    'output' => FT::SEQ(
                        FT::ACTION(SPECIAL_EFFECT, [
                            'effect' => 'incCounter',
                            'args' => ['counter' => 1, 'counterName' => clienttranslate('Arcane counter')]
                        ]),
                        FT::ACTION(
                            CHECK_CONDITION,
                            [
                                'condition' => 'hasCounterOnCard:4',
                                'effect' => FT::SEQ_OPTIONAL(
                                    FT::ACTION(TAP, []),
                                    FT::ACTION(USE_COUNTER, ['consume' => 4]),
                                    FT::ACTION(INVOKE_TOKEN, [
                                        'pId' => 'source',
                                        'tokenType' => 'YZ_Common_ManaMoth',
                                        'targetLocation' => STORMS,
                                    ]),
                                )
                            ]
                        )
                    ),
                ],
            ]
        ];
    }
}
