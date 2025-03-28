<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_SapOverflow extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_59_R2',
            'asset'  => 'ALT_BISE_B_AX_59_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Sap Overflow"),
            'typeline' => clienttranslate("Spell - Disruption"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('With every dig, the Sap becomes riskier to harvest.'),
            'artist' => "HuoMiao Studio",
            'extension' => 'WFTM',
            'subtypes'  => [DISRUPTION],
            'effectDesc' => clienttranslate('<FLEETING>.  #Choose one:  • Spend 1 counter from a card you control or in your Reserve to discard target Permanent.#  • Discard target Character in play or in Reserve.'),
            'costHand' => 4,
            'costReserve' => 4,
            'effectPlayed' => FT::SEQ(
                FT::GAIN($this, FLEETING),
                FT::XOR(
                    FT::ACTION(
                        TARGET,
                        [
                            'targetLocation' => CONTROLLED_RESERVE,
                            'targetPlayer' => ME,
                            'augmentOnly' => true,
                            'targetType' => TYPES,
                            'effect' => FT::ACTION(SPEND, [
                                'cardId' => ME,
                                'effect' => FT::ACTION(TARGET, [
                                    'targetType' => [PERMANENT],
                                    'effect' => FT::ACTION(DISCARD, []),
                                ])
                            ])
                        ]
                    ),
                    FT::ACTION(TARGET, [
                        'targetType' => [CHARACTER, TOKEN],
                        'targetLocation' => [STORM_LEFT, STORM_RIGHT, RESERVE],
                        'effect' => FT::ACTION(DISCARD, []),
                    ])
                )
            )
        ];
    }
}
