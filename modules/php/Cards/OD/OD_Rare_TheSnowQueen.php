<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_TheSnowQueen extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_38_R2',
            'asset'  => 'ALT_ALIZE_B_YZ_38_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("The Snow Queen"),
            'typeline' => clienttranslate("Character - Fairy Noble"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('The cold never bothered her.'),
            'artist' => "Taras Susak",
            'extension' => 'TBF',
            'subtypes'  => [FAIRY, NOBLE],
            'effectDesc' => clienttranslate('<ETERNAL_FS>.  #<TOUGH_FS_X>, where X is the number of exhausted cards in Reserve.  {J} You may exhaust ({T}) target card in Reserve.#  Exhausted Characters in Reserve remain exhausted during Morning.'),
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 7,
            'costReserve' => 7,
            'eternal' => true,
            'exhaustCharactersMorning' => true,
            'effectPlayed' => FT::ACTION(TARGET, [
                'targetType' => [CHARACTER, SPELL, PERMANENT],
                'targetLocation' => [RESERVE],
                'upTo' => true,
                'effect' => FT::ACTION(EXHAUST, [])
            ]),
            'dynamicTough' => 'exhaustedReserve'
        ];
    }
}
