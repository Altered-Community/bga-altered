<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_TheGrems extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_53_R1',
            'asset'  => 'ALT_BISE_B_AX_53_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("The Grems"),
            'typeline' => clienttranslate("Character - Engineer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('It\'s not demolition, but basic recycling. Or so they say.'),
            'artist' => "Atanas Lozanski",
            'extension' => 'WFTM',
            'subtypes'  => [ENGINEER],
            'effectDesc' => clienttranslate('{R} Choose up to one:  • Discard target Permanent with Hand Cost #{5} or less.#  • Sacrifice a Permanent. If you do, create a <BRASSBUG> Robot token in target Expedition.'),
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 2,
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['forest'],
            'effectReserve' => FT::XOR_OPTIONAL(
                FT::ACTION(TARGET, ['maxHandCost' => 5, 'targetType' => [PERMANENT], 'effect' => FT::ACTION(DISCARD, [])]),
                FT::ACTION(TARGET, [
                    'targetPlayer' => ME,
                    'targetType' => [PERMANENT],
                    'effect' => FT::SEQ(
                        FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
                        FT::ACTION(INVOKE_TOKEN, [
                            'pId' => 'source',
                            'tokenType' => 'AX_Common_Brassbug',
                            'targetLocation' => STORMS,
                        ]),
                    ),
                ])

            )
        ];
    }
}
