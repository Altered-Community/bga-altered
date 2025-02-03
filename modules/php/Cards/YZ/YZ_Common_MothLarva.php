<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_MothLarva extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_32_C',
            'asset'  => 'ALT_ALIZE_B_YZ_32_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Moth Larva"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('At the start of their short life, the larvae are corporeal...'),
            'artist' => "Zael",
            'extension' => 'TBF',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('{H} If there are two or more exhausted cards in Reserve, I gain 1 boost.'),
            'forest' => 1,
            'mountain' => 0,
            'ocean' => 1,
            'costHand' => 1,
            'costReserve' => 1,
            'effectHand' => FT::ACTION(CHECK_CONDITION, ['condition' => 'hasXExhaustedReserve:2', 'effect' => FT::GAIN(ME, BOOST)])
        ];
    }
}
