<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_SnoozerShroom extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_32_C',
            'asset'  => 'ALT_ALIZE_B_MU_32_C',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Snoozer Shroom"),
            'typeline' => clienttranslate("Character - Plant"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"Zzz..."'),
            'artist' => "Ba Vo",
            'extension' => 'TBF',
            'subtypes'  => [PLANT],
            'supportDesc' => clienttranslate('{D} : Target Character you control with Hand Cost {4} or less gains <ASLEEP>. (Discard me from Reserve to do this.)'),
            'supportIcon' => 'discard',
            'forest' => 3,
            'mountain' => 0,
            'ocean' => 2,
            'costHand' => 2,
            'costReserve' => 2,
            'effectSupport' => FT::ACTION(TARGET, [
                'targetPlayer' => ME,
                'targetType' => [CHARACTER, TOKEN],
                'maxHandCost' => 4,
                'effect' => FT::GAIN(EFFECT, ASLEEP),
            ]),
        ];
    }
}
