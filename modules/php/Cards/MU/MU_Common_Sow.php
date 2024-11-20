<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Sow extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_41_C',
            'asset'  => 'ALT_ALIZE_B_MU_41_C',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Sow"),
            'typeline' => clienttranslate("Spell - Boon"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('The wise gardener prepares ahead of spring.'),
            'artist' => "Romain Kurdi",
            'extension' => 'TBF',
            'subtypes'  => [BOON],
            'effectDesc' => clienttranslate('<COOLDOWN>. (If I go to Reserve after my effect resolves, exhaust me {T}. Exhausted cards can\'t be played and have no Support abilities.)  Target Character gains 1 boost.'),
            'supportDesc' => clienttranslate('{D} : The next Character you play this turn gains 1 boost. (Discard me from Reserve to do this.)'),
            'supportIcon' => 'discard',
            'costHand' => 1,
            'costReserve' => 1,
            'cooldown' => true,
            'effectPlayed' => FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, BOOST)]),
            'effectSupport' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains1Boost']),
        ];
    }
}
