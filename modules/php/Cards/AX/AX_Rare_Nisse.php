<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_Nisse extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_36_R2',
            'asset'  => 'ALT_ALIZE_B_LY_36_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Nisse"),
            'typeline' => clienttranslate("Character - Citizen"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"You never know what you\'ll find in your stockings."'),
            'artist' => "Ba Vo",
            'extension' => 'TBF',
            'subtypes'  => [CITIZEN],
            'effectDesc' => clienttranslate('{H} Roll a die. On a:  • 4+, <RESUPPLY_LOW>.  • 1-3, <EXHAUSTED_RESUPPLY_LOW>. (Put the top card of your deck in Reserve, then exhaust it {T}. Exhausted cards can\'t be played and have no Support abilities.)'),
            'forest' => 3,
            'mountain' => 0,
            'ocean' => 3,
            'costHand' => 3,
            'costReserve' => 3,
            'effectHand' => FT::ACTION(ROLL_DIE, [
                'effect' => [
                    '1-3' => FT::ACTION(RESUPPLY, ['exhausted' => true]),
                    '4+' => FT::ACTION(RESUPPLY, []),
                ],
            ]),
        ];
    }
}
