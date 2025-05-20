<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_SapDispersal extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_59_R2',
            'asset'  => 'ALT_BISE_B_MU_59_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Sap Dispersal"),
            'typeline' => clienttranslate("Spell - Boon"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('20% Sap, 40% water, 40% love... and 100% organic.'),
            'artist' => "Zael",
            'extension' => 'WFTM',
            'subtypes'  => [BOON],
            'effectDesc' => clienttranslate('#<FLEETING>.#  #Double the number of boosts# on each Character #you control# and in your Reserve.'),
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['costHand'],
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::ACTION(SPECIAL_EFFECT, ['effect' => 'doubleBoosts'])
            )
        ];
    }
}
