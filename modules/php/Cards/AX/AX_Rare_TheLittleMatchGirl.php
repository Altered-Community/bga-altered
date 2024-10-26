<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_TheLittleMatchGirl extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_34_R1',
            'asset'  => 'ALT_ALIZE_B_AX_34_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("The Little Match Girl"),
            'typeline' => clienttranslate("Character - Citizen"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('When you\'re alone in the cold, even the tiniest light can feel like salvation.'),
            'artist' => "Anh Tung",
            'extension' => 'TBF',
            'subtypes'  => [CITIZEN],
            'effectDesc' => clienttranslate('{R} If your hand is empty, draw a card. #If your Reserve is empty, draw a card.#'),
            'forest' => 3,
            'mountain' => 2,
            'ocean' => 0,
            'costHand' => 2,
            'costReserve' => 3,
            'effectReserve' => FT::SEQ(
                FT::ACTION(CHECK_CONDITION, [
                    'condition' => 'isHandEmpty',
                    'effect' => FT::ACTION(DRAW, ['players' => ME]),
                ]),
                FT::ACTION(CHECK_CONDITION, [
                    'condition' => 'isReserveEmpty',
                    'effect' => FT::ACTION(DRAW, ['players' => ME]),
                ]),
            )
        ];
    }
}
