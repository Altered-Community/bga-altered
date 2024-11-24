<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_RallyingCall extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_44_C',
            'asset'  => 'ALT_ALIZE_B_OR_44_C',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Rallying Call"),
            'typeline' => clienttranslate("Spell - Song"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('The sound of the horn stirred them from their slumber as the white shadows emerged from the woods.'),
            'artist' => "Jean-Baptiste andrier",
            'extension' => 'TBF',
            'subtypes'  => [SONG],
            'effectDesc' => clienttranslate('Target Character gains 1 boost. If it is <ASLEEP>, it loses <ASLEEP>.'),
            'costHand' => 1,
            'costReserve' => 1,
            'effectPlayed' => FT::ACTION(TARGET, ['effect' => FT::SEQ(
                FT::ACTION(GAIN, ['type' => BOOST]),
                FT::LOOSE(EFFECT, ASLEEP)
            )]),
        ];
    }
}
