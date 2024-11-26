<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_Pamola extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_34_R2',
            'asset'  => 'ALT_ALIZE_B_YZ_34_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Pamola"),
            'typeline' => clienttranslate("Character - Animal Spirit"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Pamola is always angry with those who climb to the summit.'),
            'artist' => "Justice Wong",
            'extension' => 'TBF',
            'subtypes'  => [ANIMAL, SPIRIT],
            'supportDesc' => clienttranslate('{D} : Exhaust target card in Reserve. (Discard me from Reserve to do this.)'),
            'supportIcon' => 'discard',
            'forest' => 0,
            'mountain' => 3,
            'ocean' => 2,
            'costHand' => 2,
            'costReserve' => 2,
            'effectSupport' => FT::ACTION(TARGET, [
                'targetType' => [CHARACTER, SPELL, PERMANENT],
                'targetLocation' => [RESERVE],
                'effect' => FT::ACTION(EXHAUST, [])
            ])
        ];
    }
}
