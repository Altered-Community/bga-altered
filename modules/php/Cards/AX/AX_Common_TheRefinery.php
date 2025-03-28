<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_TheRefinery extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_63_C',
            'asset'  => 'ALT_BISE_B_AX_63_C',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("The Refinery"),
            'typeline' => clienttranslate("Landmark Permanent - Construction"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('The use of Sap will alter the course of science as we know it.'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'WFTM',
            'subtypes'  => [CONSTRUCTION, LANDMARK],
            'effectDesc' => clienttranslate('When a card leaves your Reserve during the Afternoon — I gain 1 Sap counter.  {T}, Spend 3 of my Sap counters: Characters in your Reserve gain 1 boost.'),
            'costHand' => 2,
            'costReserve' => 2,
            'effectPassive' => [
                'ChooseAssignment' => [
                    'conditions' => ['isAfternoon', 'hasSameOwner', 'isFromReserve'],
                    'output' => FT::ACTION(SPECIAL_EFFECT, [
                        'effect' => 'incCounter',
                        'args' => ['counter' => 1, 'counterName' => clienttranslate('Sap counter')],
                    ]),
                ],
                'Discard' => [
                    'conditions' => ['isAfternoon', 'hasSameOwner', 'isDiscarded:reserve'],
                    'output' => FT::ACTION(SPECIAL_EFFECT, [
                        'effect' => 'incCounter',
                        'args' => ['counter' => 1, 'counterName' => clienttranslate('Sap counter')],
                    ]),
                ],
            ],
            'effectTap' => FT::ACTION(CHECK_CONDITION, [
                'condition' => 'hasCounterOnCard:3',
                'effect' => FT::SEQ(
                    FT::ACTION(USE_COUNTER, ['consume' => 3]),
                    FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostReserve'])
                )
            ], ['sourceId' => $this->id]), // VERY Important!!
        ];
    }
}
