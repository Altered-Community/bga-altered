<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_TheSnowman extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_33_R1',
            'asset'  => 'ALT_ALIZE_B_LY_33_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("The Snowman"),
            'typeline' => clienttranslate("Character - Elemental"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Which will melt first: him, or your heart?'),
            'artist' => "Ba Vo",
            'extension' => 'TBF',
            'subtypes'  => [ELEMENTAL],
            'effectDesc' => clienttranslate('{J} Unless I\'m in {O}, I gain $<FLEETING_CHAR>.'),
            'supportDesc' => clienttranslate('#{D} : <EXHAUSTED_RESUPPLY>.# (Discard me from Reserve to do this.)'),
            'supportIcon' => 'discard',
            'forest' => 2,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['forest'],
            'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'isNotInBiome:ocean', 'effect' => FT::GAIN(ME, FLEETING)]),
            'effectSupport' => FT::ACTION(RESUPPLY, ['exhausted' => true])
        ];
    }
}
