<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_IceboundTundra extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_45_C',
            'asset'  => 'ALT_ALIZE_B_LY_45_C',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Icebound Tundra"),
            'typeline' => clienttranslate("Landmark Permanent - Site"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('We can hear it, echoing in the vast expanses.'),
            'artist' => "Fahmi Fauzi",
            'extension' => 'TBF',
            'subtypes'  => [SITE, LANDMARK],
            'effectDesc' => clienttranslate('When you play a Character in a region type where its base statistic is 0 — I gain a Trial counter.  When I gain my third Trial counter — Sacrifice me. If you do, create a <DRAGON_SHADE> Illusion token in target Expedition, then return a card from your Reserve to your hand.'),
            'costHand' => 3,
            'costReserve' => 3,
            'effectPassive' => [
                'ChooseAssignment' => [
                    'conditions' => ['isMe', 'isInBiomeWithZeroStat'],
                    'output' => FT::ACTION(SPECIAL_EFFECT, [
                        'effect' => 'incCounter',
                        'args' => ['counter' => 1, 'counterName' => clienttranslate('Trial counter')],
                    ]),
                ],
                'SpecialEffect' => [
                    'listeningConditions' => ['hasCounterOnCard:3'],
                    'conditions' => ['specialEffect:gainCounter'],
                    'output' => FT::SEQ(
                        FT::ACTION(DISCARD, ['cardId' => ME, 'desc' => 'sacrifice']),
                        FT::ACTION(INVOKE_TOKEN, [
                            'pId' => 'source',
                            'tokenType' => 'NE_Common_DragonShade',
                        ]),
                        FT::ACTION(
                            TARGET,
                            [
                                'targetLocation' => [RESERVE],
                                'targetPlayer' => ME,
                                'targetType' => [CHARACTER, TOKEN, PERMANENT, SPELL],
                                'effect' => FT::RETURN_TO_HAND(),
                            ]
                        ),
                    )
                ]
            ]
        ];
    }
}
