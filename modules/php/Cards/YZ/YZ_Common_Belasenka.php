<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_Belasenka extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_35_C',
            'asset'  => 'ALT_ALIZE_B_YZ_35_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Belasenka"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('The cold snap they ride, like a shivering tide.'),
            'artist' => "Ba Vo",
            'extension' => 'TBF',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('{H} You may exhaust ({T}) target card in Reserve. (Exhausted cards can\'t be played and have no Support abilities.)'),
            'forest' => 3,
            'mountain' => 0,
            'ocean' => 3,
            'costHand' => 3,
            'costReserve' => 2,
            'effectHand' => FT::ACTION(TARGET, [
                'targetType' => [CHARACTER, SPELL, PERMANENT],
                'targetLocation' => [RESERVE],
                'upTo' => true,
                'effect' => FT::ACTION(EXHAUST, [])
            ]),
        ];
    }
}
