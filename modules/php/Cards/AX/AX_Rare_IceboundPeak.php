<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_IceboundPeak extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_46_R2',
            'asset'  => 'ALT_ALIZE_B_BR_46_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Icebound Peak"),
            'typeline' => clienttranslate("Landmark Permanent - Site"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('On the summit it waits, for freedom, for release.'),
            'artist' => "Matteo Spirito",
            'extension' => 'TBF',
            'subtypes'  => [SITE, LANDMARK],
            'effectDesc' => clienttranslate('When a Character you control gains <FLEETING_CHAR> — I gain a Trial counter.  When I gain my third Trial counter — Sacrifice me. If you do, create a <DRAGON_SHADE> Illusion token in target Expedition, then each Character you control gains 1 boost.'),
            'costHand' => 3,
            'costReserve' => 2,
            'changedStats' => ['costReserve'],
            'effectPassive' => [
                'Gain' => [
                    'conditions' => ['hasGainedFleeting'],
                    'output' => FT::ACTION(SPECIAL_EFFECT, [
                        'effect' => 'incCounter',
                        'args' => ['counter' => 1, 'counterName' => clienttranslate('Trial counter')],
                    ]),
                ],
                'SpecialEffect' => [
                    'listeningConditions' => ['hasCounterOnCard:3:EQ', 'isSource'],
                    'conditions' => ['specialEffect:gainCounter'],
                    'output' => FT::SEQ(
                        FT::ACTION(DISCARD, ['cardId' => ME, 'desc' => 'sacrifice']),
                        FT::ACTION(INVOKE_TOKEN, [
                            'pId' => 'source',
                            'tokenType' => 'NE_Common_DragonShade',
                        ]),
                        FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostAllCharacters'])
                    )
                ]
            ]
        ];
    }
}
