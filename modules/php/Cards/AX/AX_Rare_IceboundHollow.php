<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_IceboundHollow extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_46_R1',
            'asset'  => 'ALT_ALIZE_B_AX_46_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Icebound Hollow"),
            'typeline' => clienttranslate("Landmark_permanent - Site"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('In the caves and crevices, it wails and calls to us.'),
            'artist' => "Kevin Sidharta",
            'extension' => 'TBF',
            'subtypes'  => [SITE, LANDMARK],
            'effectDesc' => clienttranslate('When a card goes from your Hand or deck to Reserve — I gain a Trial counter.  When I gain my third Trial counter — Sacrifice me. If you do, create a <DRAGON_SHADE> Illusion token in target Expedition, then ready your cards in Reserve.'),
            'costHand' => 3,
            'costReserve' => 2,
            'changedStats' => ['costReserve'],
            'effectPassive' => [
                'Discard' => [
                    'conditions' => ['hasSameOwner', 'isDiscarded:hand:reserve', 'excludeSelf'],
                    'output' => FT::ACTION(SPECIAL_EFFECT, [
                        'effect' => 'incCounter',
                        'args' => ['counter' => 1, 'counterName' => clienttranslate('Trial counter')],
                    ]),
                ],
                'Resupply' => [
                    'conditions' => ['isMe', 'excludeSelf'],
                    'output' => FT::ACTION(SPECIAL_EFFECT, [
                        'effect' => 'incCounter',
                        'args' => ['counter' => 1, 'counterName' => clienttranslate('Trial counter')],
                    ]),
                ],
                'SpecialEffect' => [
                    'listeningConditions' => ['hasCounterOnCard:3:EQ', 'isSourceOrAugment'],
                    'conditions' => ['specialEffect:gainCounter'],
                    'output' => FT::SEQ(
                        FT::ACTION(DISCARD, ['cardId' => ME, 'desc' => 'sacrifice']),
                        FT::ACTION(INVOKE_TOKEN, [
                            'pId' => 'source',
                            'tokenType' => 'NE_Common_DragonShade',
                        ]),
                        FT::ACTION(SPECIAL_EFFECT, ['effect' => 'readyAllReserve'])
                    )
                ]
            ],
        ];
    }
}
