<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_LicenseWithdrawal extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_59_C',
            'asset'  => 'ALT_BISE_B_OR_59_C',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("License Withdrawal"),
            'typeline' => clienttranslate("Spell - Disruption Maneuver"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('"Enough of this mess!"'),
            'artist' => "Justice Wong",
            'extension' => 'WFTM',
            'subtypes'  => [DISRUPTION, MANEUVER],
            'effectDesc' => clienttranslate('$<FLEETING>.  Choose one:  • Discard target <BOOSTED> Character.  • Discard target Permanent.'),
            'costHand' => 3,
            'costReserve' => 3,
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::XOR(
                    FT::ACTION(TARGET, [
                        'targetType' => [CHARACTER, TOKEN],
                        'statuses' => BOOST,
                        'effect' => FT::ACTION(DISCARD, [])
                    ]),
                    FT::ACTION(TARGET, [
                        'targetType' => [PERMANENT],
                        'effect' => FT::ACTION(DISCARD, [])
                    ]),
                )
            )
        ];
    }
}
