<?php

namespace ALT\Cards\NE;

class NE_Common_DragonShade extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_NE_02_C',
            'asset'  => 'ALT_ALIZE_B_NE_02_C',

            'faction'  => FACTION_NE,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Dragon Shade"),
            'typeline' => clienttranslate("Token Character - Illusion"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('It is a shadow, a phantom, always hissing, always whispering. It wants to be found. It wants to be unleashed.'),
            'artist' => "Zero Wen",
            'extension' => 'TBF',
            'subtypes'  => [ILLUSION],
            'effectDesc' => clienttranslate('(If I leave the Expedition zone, remove me from the game.)'),
            'forest' => 5,
            'mountain' => 5,
            'ocean' => 5,
            'token' => true
        ];
    }
}
