<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_WalrusScout extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_36_R1',
            'asset'  => 'ALT_ALIZE_B_AX_36_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Walrus Scout"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"Goo goo g\'joob, g\'goo goo g\'joob"'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'TBF',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('#{R} You may exhaust ({T}) target card in Reserve.# (Exhausted cards can\'t be played and have no Support abilities.)'),
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 2,
            'costHand' => 3,
            'costReserve' => 1,
            'changedStats' => ['ocean'],
            'effectReserve' =>  FT::ACTION(TARGET, [
                'targetType' => [CHARACTER, SPELL, PERMANENT],
                'targetLocation' => [RESERVE],
                'upTo' => true,
                'effect' => FT::ACTION(EXHAUST, [])
            ]),
        ];
    }
}
