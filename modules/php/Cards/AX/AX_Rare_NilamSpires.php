<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_NilamSpires extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_62_R2',
            'asset'  => 'ALT_BISE_B_YZ_62_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Nilam Spires"),
            'typeline' => clienttranslate("Landmark Permanent - Construction"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Observing the Tumult requires taking a high-level perspective on it, and mastering it requires knowledge.'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'WFTM',
            'subtypes'  => [CONSTRUCTION, LANDMARK],
            'effectDesc' => clienttranslate('When #another Permanent joins your Expeditions or Landmarks# — I gain 1 Arcane counter. Then, you may exhaust me ({T}) and #spend 3# of my Arcane counters to create a #<BRASSBUG> Robot# token in target Expedition.'),
            'costHand' => 3,
            'costReserve' => 3,
            'changedStats' => ['costHand', 'costReserve'],
            'effectPassive' => [
                'ChooseAssignment' => [
                    'conditions' => ['isCardPlayed:permanent', 'excludeSelf'],
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
                                        'tokenType' => 'AX_Common_Brassbug',
                                        'targetLocation' => STORMS,
                                    ]),
                                )
                            ]
                        )
                    ),
                ],
                'InvokeToken' => [
                    'conditions' => ['isCardPlayed:permanent', 'excludeSelf', 'isMeInvoke'],
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
                                        'tokenType' => 'AX_Common_Brassbug',
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
