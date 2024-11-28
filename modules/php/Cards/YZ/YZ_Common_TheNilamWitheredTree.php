<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_TheNilamWitheredTree extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_45_C',
            'asset'  => 'ALT_ALIZE_B_YZ_45_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("The Nilam, Withered Tree"),
            'typeline' => clienttranslate("Landmark Permanent - Site"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Long after it died, the Nilam still held life as the nesting grounds for the Mana Moths.'),
            'artist' => "Khoa Viet",
            'extension' => 'TBF',
            'subtypes'  => [SITE, LANDMARK],
            'effectDesc' => clienttranslate('When you exhaust a card in Reserve — You may exhaust me ({T}) to create a <MANA_MOTH> Illusion token in target Expedition.  {J} You may exhaust target card in Reserve. (Exhausted cards can\'t be played and have no Support abilities.)'),
            'costHand' => 4,
            'costReserve' => 4,
            'effectPassive' => [
                'Exhaust' => [
                    'condition' => 'isMe',
                    'output' => FT::SEQ_OPTIONAL(
                        FT::ACTION(TAP, []),
                        FT::ACTION(INVOKE_TOKEN, [
                            'pId' => 'source',
                            'tokenType' => 'YZ_Common_ManaMoth',
                            'targetLocation' => STORMS,
                        ]),
                    )
                ]
            ],
            'effectPlayed' => FT::ACTION(TARGET, [
                'targetType' => [CHARACTER, SPELL, PERMANENT],
                'upTo' => true,
                'targetLocation' => [RESERVE],
                'effect' => FT::ACTION(EXHAUST, [])
            ])

        ];
    }
}
