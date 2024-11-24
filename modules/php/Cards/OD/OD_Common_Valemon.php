<?php

namespace ALT\Cards\OD;

class OD_Common_Valemon extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_39_C',
            'asset'  => 'ALT_ALIZE_B_OR_39_C',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Valemon"),
            'typeline' => clienttranslate("Character - Animal Noble"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Promise me to wait, and I will show you my real face.'),
            'artist' => "Matteo Spirito",
            'extension' => 'TBF',
            'subtypes'  => [ANIMAL, NOBLE],
            'effectDesc' => clienttranslate('Unless you have eight or more Mana Orbs, I am $<DEFENDER>.'),
            'forest' => 6,
            'mountain' => 6,
            'ocean' => 6,
            'costHand' => 4,
            'costReserve' => 4,
            'dynamicDefender' => '1:hasLess8Mana'
        ];
    }
}
