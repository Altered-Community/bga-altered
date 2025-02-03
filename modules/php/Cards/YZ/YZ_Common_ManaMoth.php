<?php

namespace ALT\Cards\YZ;

class YZ_Common_ManaMoth extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_47_C',
            'asset'  => 'ALT_ALIZE_B_YZ_47_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Mana Moth"),
            'typeline' => clienttranslate("Token Character - Illusion"),
            'type'  => TOKEN,
            // 'flavorText'  => clienttranslate('During their short existence, they continuously leak an incredibly pure Mana into their environment.'),
            'artist' => "HuoMiao Studio",
            'extension' => 'TBF',
            'subtypes'  => [ILLUSION],
            'effectDesc' => clienttranslate('(If I leave the Expedition zone, remove me from the game.)'),
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 2,
            'token' => true,
        ];
    }
}
