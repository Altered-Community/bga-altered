<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_Conscription extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_60_C',
            'asset'  => 'ALT_BISE_B_OR_60_C',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Conscription"),
            'typeline' => clienttranslate("Spell - Maneuver"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('You\'re in the army now.'),
            'artist' => "Romain Kurdi",
            'extension' => 'WFTM',
            'subtypes'  => [MANEUVER],
            'effectDesc' => clienttranslate('$<FLEETING>.  Target an Expedition. Create X <ORDIS_RECRUIT> Soldier tokens in it, where X is the number of cards in target player\'s Reserve.'),
            'costHand' => 2,
            'costReserve' => 2,
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::ACTION(TARGET_EXPEDITION, ['effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'invokeXRecruitReserve'])])
            )
        ];
    }
}
