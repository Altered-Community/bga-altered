<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_MightySimbi extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_37_C',
            'asset'  => 'ALT_ALIZE_B_MU_37_C',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Mighty Simbi"),
            'typeline' => clienttranslate("Character - Plant Elemental"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('A single seed can start a forest.'),
            'artist' => "Gael Giudicelli",
            'extension' => 'TBF',
            'subtypes'  => [PLANT, ELEMENTAL],
            'effectDesc' => clienttranslate('When my Expedition moves forward due to {V} — You may sacrifice me to draw a card.'),
            'forest' => 4,
            'mountain' => 0,
            'ocean' => 4,
            'costHand' => 4,
            'costReserve' => 3,
            'effectPassive' => [
                'AfterDusk' => [
                    'condition' => 'movesStormsWithForest',
                    'output' => FT::SEQ_OPTIONAL(
                        FT::ACTION(DISCARD, ['cardId' => ME, 'desc' => 'sacrifice']),
                        FT::ACTION(DRAW, ['players' => ME]),
                    )
                ],
            ],
        ];
    }
}
