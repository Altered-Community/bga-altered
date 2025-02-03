<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_MothtoaFlame extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_41_R2',
            'asset'  => 'ALT_ALIZE_B_YZ_41_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Moth to a Flame"),
            'typeline' => clienttranslate("Spell - Maneuver"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('During the scant hours of their brief existence, the Moths flutter about, carrying only the idea of themselves.'),
            'artist' => "HuoMiao Studio",
            'extension' => 'TBF',
            'subtypes'  => [MANEUVER],
            'effectDesc' => clienttranslate('$<COOLDOWN>.  Create a <MANA_MOTH> Illusion token #in each of your Expeditions#.'),
            'costHand' => 4,
            'costReserve' => 3,
            'changedStats' => ['costHand', 'costReserve'],
            'cooldown' => true,
            'effectPlayed' => FT::SEQ(
                FT::ACTION(INVOKE_TOKEN, [
                    'pId' => 'source',
                    'tokenType' => 'YZ_Common_ManaMoth',
                    'targetLocation' => [STORM_LEFT],
                ]),
                FT::ACTION(INVOKE_TOKEN, [
                    'pId' => 'source',
                    'tokenType' => 'YZ_Common_ManaMoth',
                    'targetLocation' => [STORM_RIGHT],
                ]),
            )
        ];
    }
}
