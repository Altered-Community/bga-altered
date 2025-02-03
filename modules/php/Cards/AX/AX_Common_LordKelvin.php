<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_LordKelvin extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_44_C',
            'asset'  => 'ALT_ALIZE_B_AX_44_C',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Lord Kelvin"),
            'typeline' => clienttranslate("Character - Scholar Noble"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"When you are face to face with a difficulty, you are up against a discovery."'),
            'artist' => "Anh Tung",
            'extension' => 'TBF',
            'subtypes'  => [SCHOLAR, NOBLE],
            'effectDesc' => clienttranslate('{R} You may exhaust ({T}) target card in Reserve. (Exhausted cards can\'t be played and have no Support abilities.)'),
            'forest' => 4,
            'mountain' => 4,
            'ocean' => 4,
            'costHand' => 4,
            'costReserve' => 4,
            'effectReserve' =>  FT::ACTION(TARGET, [
                'targetType' => [CHARACTER, SPELL, PERMANENT],
                'targetLocation' => [RESERVE],
                'upTo' => true,
                'effect' => FT::ACTION(EXHAUST, [])
            ]),
        ];
    }
}
