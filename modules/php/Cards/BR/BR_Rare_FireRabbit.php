<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_FireRabbit extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_32_R1',
            'asset'  => 'ALT_ALIZE_B_BR_32_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Fire Rabbit"),
            'typeline' => clienttranslate("Character - Animal Spirit"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Hot bunny in your area wants to meet!'),
            'artist' => "Khoa Viet",
            'extension' => 'TBF',
            'subtypes'  => [ANIMAL, SPIRIT],
            'effectDesc' => clienttranslate('{H} You may have me gain <FLEETING_CHAR>. If you do, another target Character gains 1 boost.'),
            'supportDesc' => clienttranslate('#{D} : The next Character you play this turn gains 1 boost.# (Discard me from Reserve to do this.)'),
            'supportIcon' => 'discard',
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 1,
            'costReserve' => 1,
            'changedStats' => ['ocean'],
            'effectHand' => FT::SEQ_OPTIONAL(FT::GAIN(ME, FLEETING), FT::ACTION(TARGET, ['excludeSelf' => true, 'effect' => FT::ACTION(GAIN, ['type' => BOOST])])),
            'effectSupport' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains1Boost']),
        ];
    }
}
