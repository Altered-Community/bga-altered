<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_IceboundPass extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_46_C',
            'asset'  => 'ALT_ALIZE_B_YZ_46_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Icebound Pass"),
            'typeline' => clienttranslate("Landmark Permanent - Site"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('We can hear it roar in the snowy passes.'),
            'artist' => "Justice Wong",
            'extension' => 'TBF',
            'subtypes'  => [SITE, LANDMARK],
            'effectDesc' => clienttranslate('When you exhaust a card in Reserve — I gain a Trial counter.  When I gain my third Trial counter — Sacrifice me. If you do, create a <DRAGON_SHADE> Illusion token in target Expedition, then draw a card.'),
            'costHand' => 4,
            'costReserve' => 4,
            'effectPassive' => [
                'Exhaust' => [
                    'conditions' => ['isMe', 'isExhaustedInLocation:reserve'],
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
                        FT::ACTION(DRAW, ['players' => ME]),
                    )
                ]
            ],
        ];
    }
}
