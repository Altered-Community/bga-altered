<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_MothLarva extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_32_R1',
            'asset'  => 'ALT_ALIZE_B_YZ_32_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Moth Larva"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('At the start of their short life, the larvae are corporeal...'),
            'artist' => "Zael",
            'extension' => 'TBF',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('#{J}# If there are two or more exhausted cards in Reserve, I gain 1 boost.'),
            'supportDesc' => clienttranslate('#{D} : Exhaust target card in Reserve.# (Discard me from Reserve to do this.)'),
            'supportIcon' => 'discard',
            'forest' => 1,
            'mountain' => 0,
            'ocean' => 1,
            'costHand' => 1,
            'costReserve' => 1,
            'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'hasXExhaustedReserve:2', 'effect' => FT::GAIN(ME, BOOST)]),
            'effectSupport' => FT::ACTION(TARGET, [
                'targetType' => [CHARACTER, SPELL, PERMANENT],
                'targetLocation' => [RESERVE],
                'effect' => FT::ACTION(EXHAUST, [])
            ])

        ];
    }
}
