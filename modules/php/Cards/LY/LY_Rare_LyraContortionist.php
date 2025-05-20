<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_LyraContortionist extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_51_R1',
            'asset'  => 'ALT_BISE_B_LY_51_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Lyra Contortionist"),
            'typeline' => clienttranslate("Character - Artist"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('The Lyra from the Tisdhera clan will bend over backwards for their community.'),
            'artist' => "Khoa Viet",
            'extension' => 'WFTM',
            'subtypes'  => [ARTIST],
            'effectDesc' => clienttranslate('#{R} I lose <FLEETING>.#'),
            'supportDesc' => clienttranslate('{I} I don\'t count towards your Reserve limit.'),
            'supportIcon' => 'infinity',
            'forest' => 2,
            'mountain' => 3,
            'ocean' => 0,
            'costHand' => 2,
            'costReserve' => 3,
            'changedStats' => ['costReserve'],
            'ignoreReserveLimit' => true,
            'effectReserve' => FT::LOOSE(ME, FLEETING)
        ];
    }
}
