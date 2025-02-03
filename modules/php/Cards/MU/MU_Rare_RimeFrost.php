<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_RimeFrost extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_39_R2',
            'asset'  => 'ALT_ALIZE_B_YZ_39_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Rime Frost"),
            'typeline' => clienttranslate("Spell - Disruption"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('A late frost delays the spring.'),
            'artist' => "HuoMiao Studio",
            'extension' => 'TBF',
            'subtypes'  => [DISRUPTION],
            'effectDesc' => clienttranslate('#Choose one:  • Discard target exhausted card from a Reserve.#  • Exhaust ({T}) target card in Reserve. (Exhausted cards can\'t be played and have no Support abilities.)'),
            'costHand' => 1,
            'costReserve' => 2,
            'effectPlayed' => FT::XOR(
                FT::ACTION(TARGET, [
                    'targetType' => [CHARACTER, SPELL, PERMANENT],
                    'targetLocation' => [RESERVE],
                    'isTapped' => true,
                    'effect' => FT::ACTION(DISCARD, [])
                ]),
                FT::ACTION(TARGET, [
                    'targetType' => [CHARACTER, SPELL, PERMANENT],
                    'targetLocation' => [RESERVE],
                    'effect' => FT::ACTION(EXHAUST, [])
                ]),
            )
        ];
    }
}
