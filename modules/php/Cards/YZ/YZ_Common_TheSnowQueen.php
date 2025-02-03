<?php

namespace ALT\Cards\YZ;

class YZ_Common_TheSnowQueen extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_38_C',
            'asset'  => 'ALT_ALIZE_B_YZ_38_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("The Snow Queen"),
            'typeline' => clienttranslate("Character - Fairy Noble"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('The cold never bothered her.'),
            'artist' => "Taras Susak",
            'extension' => 'TBF',
            'subtypes'  => [FAIRY, NOBLE],
            'effectDesc' => clienttranslate('$<ETERNAL_FS>.  Exhausted Characters in Reserve remain exhausted during Morning.'),
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 7,
            'costReserve' => 7,
            'eternal' => true,
            'exhaustCharactersMorning' => true,

        ];
    }
}
