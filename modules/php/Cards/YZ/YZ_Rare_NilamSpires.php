<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_NilamSpires extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_62_R1',
            'asset'  => 'ALT_BISE_B_YZ_62_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Nilam Spires"),
            'typeline' => clienttranslate("Landmark_permanent - Construction"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Observing the Tumult requires taking a high-level perspective on it, and mastering it requires knowledge.'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'WFTM',
            'subtypes'  => [CONSTRUCTION, LANDMARK],
            'effectDesc' => clienttranslate('When you play a Spell — I gain 1 Arcane counter. Then, you may exhaust me ({T}) and #spend 3# of my Arcane counters to create a <MANA_MOTH> Illusion token in target Expedition.'),
            'costHand' => 3,
            'costReserve' => 3,
            'changedStats' => ['costHand', 'costReserve'],
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
                                'condition' => 'hasCounterOnCard:3',
                                'effect' => FT::SEQ_OPTIONAL(
                                    FT::ACTION(TAP, []),
                                    FT::ACTION(USE_COUNTER, ['consume' => 3]),
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
