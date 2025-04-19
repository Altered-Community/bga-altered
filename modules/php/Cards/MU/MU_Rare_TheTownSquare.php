<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_TheTownSquare extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_63_R2',
            'asset'  => 'ALT_BISE_B_OR_63_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("The Town Square"),
            'typeline' => clienttranslate("Landmark_permanent - Site"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('In light of the Ordis\' well-known organizational advantages, the Factions entrusted them with outpost logistics.'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'WFTM',
            'subtypes'  => [SITE, LANDMARK],
            'effectDesc' => clienttranslate('At Dusk — I gain 1 Morale counter per Character you control.  {T}, Spend 6 of my Morale counters: #Characters you control# gain 1 boost.'),
            'costHand' => 3,
            'costReserve' => 3,
            'changedStats' => ['costHand', 'costReserve'],
            'effectPassive' => [
                'BeforeDusk' => [
                    'condition' => 'isMe',
                    'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'counterPerCharacter'])
                ]
            ],
            'extraDatas' => ['counter' => 0, 'counterName' => clienttranslate('Morale counter')],
            'effectTap' => FT::ACTION(CHECK_CONDITION, [
                'condition' => 'hasCounterOnCard:6',
                'effect' => FT::SEQ(
                    FT::ACTION(USE_COUNTER, ['consume' => 6]),
                    [
                        'action' => SPECIAL_EFFECT,
                        'args' => ['effect' => 'boostAllCharacters'],
                    ],
                )
            ], ['sourceId' => $this->id]), // VERY Important!!
        ];
    }
}
