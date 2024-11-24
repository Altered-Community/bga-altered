<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_RallyingCall extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_44_R1',
            'asset'  => 'ALT_ALIZE_B_OR_44_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Rallying Call"),
            'typeline' => clienttranslate("Spell - Song"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('The sound of the horn stirred them from their slumber as the white shadows emerged from the woods.'),
            'artist' => "Jean-Baptiste andrier",
            'extension' => 'TBF',
            'subtypes'  => [SONG],
            'effectDesc' => clienttranslate('Target Character gains 1 boost. If it is <ASLEEP>, #it gains <ANCHORED># and loses <ASLEEP>. (At Rest, it doesn\'t go to Reserve and loses Anchored).'),
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['costHand', 'costReserve'],
            'effectPlayed' => FT::ACTION(TARGET, ['effect' => FT::SEQ(
                FT::ACTION(GAIN, ['type' => BOOST]),
                FT::GAIN(EFFECT, ANCHORED),
                FT::LOOSE(EFFECT, ASLEEP)
            )]),
        ];
    }
}
