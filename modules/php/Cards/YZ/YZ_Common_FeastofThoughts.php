<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_FeastofThoughts extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_61_C',
            'asset'  => 'ALT_BISE_B_YZ_61_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Feast of Thoughts"),
            'typeline' => clienttranslate("Spell - Conjuration Disruption"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('When the Remanence strikes, ideas burst out of one\'s mind like water from a dam.'),
            'artist' => "HuoMiao Studio",
            'extension' => 'WFTM',
            'subtypes'  => [CONJURATION, DISRUPTION],
            'effectDesc' => clienttranslate('Choose X+1, where X is my number of Arcane counters:  • Draw a card.  • Create a <MANA_MOTH> Illusion token in target Expedition.  • Remove 3 counters from target card in play or in Reserve.  • <SABOTAGE>.'),
            'supportDesc' => clienttranslate('{I} When you play another Spell — I gain 1 Arcane counter, up to a max of 3.'),
            'supportIcon' => 'infinity',
            'costHand' => 3,
            'costReserve' => 5,
            'effectInfinity' => [
                'effectPassive' => [
                    'ChooseAssignment' => [
                        'conditions' => ['isCardPlayed:spell', 'excludeSelf'],
                        'output' => FT::ACTION(SPECIAL_EFFECT, [
                            'effect' => 'incCounter',
                            'args' => ['counter' => 1, 'counterName' => clienttranslate('Arcane counter'), 'maxCounter' => 3]
                        ])
                    ],
                ]
            ],
            'effectPlayed' =>
            [
                'type' => NODE_OR,
                'args' => ['n' => 'sourceCounter1'],
                // 'pId' => 'source',
                'childs' => [
                    FT::ACTION(DRAW, ['players' => ME]),
                    FT::ACTION(INVOKE_TOKEN, [
                        'pId' => 'source',
                        'tokenType' => 'YZ_Common_ManaMoth',
                        'targetLocation' => STORMS,
                    ]),
                    FT::ACTION(TARGET, [
                        'targetType' => [CHARACTER, SPELL, PERMANENT, TOKEN],
                        'targetLocation' => [STORM_LEFT, STORM_RIGHT, LANDMARK, RESERVE],
                        'augmentOnly' => true,
                        'effect' => FT::ACTION(LOOSE, ['upTo' => true, 'type' => 'counter', 'n' => 3])
                    ]),
                    FT::ACTION(TARGET, [
                        'targetType' => [CHARACTER, SPELL, PERMANENT],
                        'targetLocation' => [RESERVE],
                        'upTo' => true,
                        'effect' => FT::ACTION(DISCARD, []),
                    ]),
                ]
            ]

        ];
    }
}
