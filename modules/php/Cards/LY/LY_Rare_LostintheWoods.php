<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_LostintheWoods extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_42_R2',
            'asset'  => 'ALT_ALIZE_B_MU_42_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Lost in the Woods"),
            'typeline' => clienttranslate("Spell - Disruption"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('They\'re not out of the woods yet.'),
            'artist' => "HuoMiao Studio",
            'extension' => 'TBF',
            'subtypes'  => [DISRUPTION],
            'effectDesc' => clienttranslate('<FLEETING>.  Choose one:  • Send target Character to Reserve. #If it wasn\'t in {V}, its controller draws a card.#  • Discard target Permanent.'),
            'costHand' => 3,
            'costReserve' => 3,
           'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::XOR(
                    FT::ACTION(TARGET, ['effect' =>
                    FT::SEQ(
                        FT::DISCARD_TO_RESERVE(),
                        FT::ACTION(CHECK_CONDITION, ['condition' => 'isDiscardedCardNotInBiome:forest', 'effect' => FT::ACTION(DRAW, ['players' => OPPONENT])])
                    )])
                ),
                FT::ACTION(TARGET, ['targetType' => [PERMANENT], 'effect' => FT::ACTION(DISCARD, [])]),
            )
        ];
    }
}
