<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_LordKelvin extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_44_R2',
            'asset'  => 'ALT_ALIZE_B_AX_44_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Lord Kelvin"),
            'typeline' => clienttranslate("Character - Scholar Noble"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"When you are face to face with a difficulty, you are up against a discovery."'),
            'artist' => "Anh Tung",
            'extension' => 'TBF',
            'subtypes'  => [SCHOLAR, NOBLE],
            'effectDesc' => clienttranslate('{R} You may exhaust ({T}) target card in Reserve. (Exhausted cards can\'t be played and have no Support abilities.)'),
            'forest' => 4,
            'mountain' => 3,
            'ocean' => 4,
            'costHand' => 4,
            'costReserve' => 3,
            'changedStats' => ['mountain', 'costReserve'],
            'effectReserve' =>  FT::ACTION(TARGET, [
                'targetType' => [CHARACTER, SPELL, PERMANENT],
                'targetLocation' => [RESERVE],
                'upTo' => true,
                'effect' => FT::ACTION(EXHAUST, [])
            ]),
        ];
    }
}
