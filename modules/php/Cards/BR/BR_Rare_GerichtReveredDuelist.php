<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_GerichtReveredDuelist extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_37_R1',
            'asset'  => 'ALT_ALIZE_B_BR_37_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Gericht, Revered Duelist"),
            'typeline' => clienttranslate("Character - Adventurer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"What doesn\'t kill you makes you stronger."'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'TBF',
            'subtypes'  => [ADVENTURER],
            'effectDesc' => clienttranslate('#If I would gain <FLEETING_CHAR>, I gain 1 boost instead#.'),
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 3,
            'costReserve' => 4,
            'dynamicGainReplace' => [FLEETING => BOOST]
        ];
    }
}
