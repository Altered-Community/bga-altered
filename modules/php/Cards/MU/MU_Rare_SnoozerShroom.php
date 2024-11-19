<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_SnoozerShroom extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_32_R1',
            'asset'  => 'ALT_ALIZE_B_MU_32_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Snoozer Shroom"),
            'typeline' => clienttranslate("Character - Plant"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"Zzz..."'),
            'artist' => "Ba Vo",
            'extension' => 'TBF',
            'subtypes'  => [PLANT],
            'effectDesc' => clienttranslate('#{H} You may pay {2}. If you do, target Character in the Expedition facing me gains <ASLEEP>.#'),
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
            'effectHand' => FT::SEQ_OPTIONAL(
                FT::ACTION(PAY, ['pay' => 2]),
                FT::ACTION(TARGET, [
                    'targetPlayer' => OPPONENT,
                    'targetLocation' => 'source',
                    'targetType' => [CHARACTER, TOKEN],
                    'effect' => FT::GAIN(EFFECT, ASLEEP),
                ])
            )
        ];
    }
}
