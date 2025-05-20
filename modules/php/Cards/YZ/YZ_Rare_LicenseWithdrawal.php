<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_LicenseWithdrawal extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_59_R2',
            'asset'  => 'ALT_BISE_B_OR_59_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("License Withdrawal"),
            'typeline' => clienttranslate("Spell - Disruption Maneuver"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('"Enough of this mess!"'),
            'artist' => "Justice Wong",
            'extension' => 'WFTM',
            'subtypes'  => [DISRUPTION, MANEUVER],
            'effectDesc' => clienttranslate('<FLEETING>.  Choose one:  • Discard target <BOOSTED> Character #with Hand Cost {3} or less.#  • Discard target Permanent #with Hand Cost {3} or less.#'),
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['costHand', 'costReserve'],
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::XOR(
                    FT::ACTION(TARGET, [
                        'targetType' => [CHARACTER, TOKEN],
                        'statuses' => BOOST,
                        'maxHandCost' => 3,
                        'effect' => FT::ACTION(DISCARD, [])
                    ]),
                    FT::ACTION(TARGET, [
                        'targetType' => [PERMANENT],
                        'maxHandCost' => 3,
                        'effect' => FT::ACTION(DISCARD, [])
                    ]),
                )
            )
        ];
    }
}
