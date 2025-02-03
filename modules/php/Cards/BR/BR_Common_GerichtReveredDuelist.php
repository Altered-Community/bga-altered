<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_GerichtReveredDuelist extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_37_C',
            'asset'  => 'ALT_ALIZE_B_BR_37_C',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Gericht, Revered Duelist"),
            'typeline' => clienttranslate("Character - Adventurer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"What doesn\'t kill you makes you stronger."'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'TBF',
            'subtypes'  => [ADVENTURER],
            'effectDesc' => clienttranslate('When I gain <FLEETING_CHAR> — I gain 1 boost.  I can gain <FLEETING_CHAR> even if I was already <FLEETING_CHAR>.'),
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 3,
            'costReserve' => 4,
            'canAlwaysGainFleeting' => true,
            'effectPassive' => [
                'Gain' => [
                    'condition' => 'hasGained:fleeting',
                    'output' => FT::GAIN(ME, BOOST)
                ],
            ]
        ];
    }
}
