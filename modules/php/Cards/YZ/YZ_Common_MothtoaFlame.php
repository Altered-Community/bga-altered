<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_MothtoaFlame extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_41_C',
            'asset'  => 'ALT_ALIZE_B_YZ_41_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Moth to a Flame"),
            'typeline' => clienttranslate("Spell - Maneuver"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('During the scant hours of their brief existence, the Moths flutter about, carrying only the idea of themselves.'),
            'artist' => "HuoMiao Studio",
            'extension' => 'TBF',
            'subtypes'  => [MANEUVER],
            'effectDesc' => clienttranslate('<COOLDOWN>. (If I go to Reserve after my effect resolves, exhaust me {T}. Exhausted cards can\'t be played and have no Support abilities.)  Create a <MANA_MOTH> Illusion token in target Expedition.'),
            'costHand' => 3,
            'costReserve' => 2,
            'cooldown' => true,
            'effectPlayed' => FT::ACTION(INVOKE_TOKEN, [
                'pId' => 'source',
                'tokenType' => 'YZ_Common_ManaMoth',
                'targetLocation' => STORMS,
            ]),

        ];
    }
}
