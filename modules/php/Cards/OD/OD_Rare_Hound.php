<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Hound extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_33_R1',
            'asset'  => 'ALT_ALIZE_B_OR_33_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Hound"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Like a dog with a bone.'),
            'artist' => "Anh Tung",
            'extension' => 'TBF',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('{J} If my Expedition is behind, I gain 1 boost.'),
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 0,
            'costHand' => 1,
            'costReserve' => 1,
            'changedStats' => ['forest', 'mountain', 'costHand', 'costReserve'],
            'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'myExpeditionIsBehind', 'effect' => FT::GAIN(ME, BOOST)])

        ];
    }
}
