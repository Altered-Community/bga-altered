<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Heimdall extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_38_R2',
            'asset'  => 'ALT_ALIZE_B_LY_38_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Heimdall"),
            'typeline' => clienttranslate("Character - Soldier Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Proud guardian of the Bifröst, he decides who gets to switch sides.'),
            'artist' => "Fahmi Fauzi",
            'extension' => 'TBF',
            'subtypes'  => [SOLDIER, DEITY],
            'effectDesc' => clienttranslate('{H} You may have target Character switch Expeditions. (It leaves its Expedition and joins its controller\'s other Expedition.)'),
            'forest' => 4,
            'mountain' => 4,
            'ocean' => 4,
            'costHand' => 4,
            'costReserve' => 4,
            'effectPlayed' => FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN], 'effect' => FT::ACTION(MOVE_CARD, [])]),

        ];
    }
}
