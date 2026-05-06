<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class OD_Rare_FragrantMeerkat extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_108_R2',
            'asset'  => 'ALT_EOLE_B_LY_108_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Fragrant Meerkat"),
            'typeline' => clienttranslate("Character - Animal Artist"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Do you smell a rat ? Nope, that\'s just me!'),
            'artist' => "Zaeliven",
            'extension' => 'ROC',
            'subtypes'  => [ANIMAL, ARTIST],
            'effectDesc' => clienttranslate('#If you would roll a die, you may add 1 to its result.# (Choose after you see the result.)'),
            'forest' => 3,
            'mountain' => 0,
            'ocean' => 3,
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['mountain', 'costReserve'],
            'addRoll' => 1,
        ];
    }
}
