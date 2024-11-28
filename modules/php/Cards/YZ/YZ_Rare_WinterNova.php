<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_WinterNova extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_37_R1',
            'asset'  => 'ALT_ALIZE_B_YZ_37_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Winter Nova"),
            'typeline' => clienttranslate("Spell - Disruption Maneuver"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('A forgotten power waits to be awakened.'),
            'artist' => "Edward Chee & Seok Yeong",
            'extension' => 'TBF',
            'subtypes'  => [DISRUPTION, MANEUVER],
            'effectDesc' => clienttranslate('<FLEETING>.  Choose three. #You may pick the same option multiple times:#  • Exhaust up to two cards in Reserve.  • Create two <MANA_MOTH> Illusion tokens in target Expedition.  • Discard target Permanent.  • Target player sacrifices a Character.'),
            'costHand' => 8,
            'costReserve' => 8,
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                [
                    'type' => NODE_OR,
                    'args' => ['n' => 3, 'canReuse' => 3],
                    'childs' => [
                        FT::ACTION(TARGET, [
                            'targetType' => [CHARACTER, SPELL, PERMANENT],
                            'upTo' => true,
                            'n' => 2,
                            'targetLocation' => [RESERVE],
                            'effect' => FT::ACTION(EXHAUST, [])
                        ]),
                        FT::SEQ(
                            FT::ACTION(INVOKE_TOKEN, [
                                'pId' => 'source',
                                'tokenType' => 'YZ_Common_ManaMoth',
                                'targetLocation' => STORMS,
                            ]),
                            FT::ACTION(INVOKE_TOKEN, [
                                'pId' => 'source',
                                'tokenType' => 'YZ_Common_ManaMoth',
                                'targetLocation' => STORMS,
                            ]),
                        ),
                        FT::ACTION(TARGET, ['targetType' => [PERMANENT], 'effect' => FT::ACTION(DISCARD, [])]),
                        FT::ACTION(
                            TARGET_PLAYER,
                            [
                                'opponentsOnly' => false,
                                'effect' => FT::ACTION(TARGET, [
                                    'targetPlayer' => ME,
                                    'targetType' => [CHARACTER, TOKEN],
                                    'n' => 1,
                                    'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
                                ])
                            ]
                        )
                    ]
                ]
            )
        ];
    }
}
