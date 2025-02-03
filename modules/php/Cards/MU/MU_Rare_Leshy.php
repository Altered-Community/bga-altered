<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_Leshy extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_38_R1',
            'asset'  => 'ALT_ALIZE_B_MU_38_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Leshy"),
            'typeline' => clienttranslate("Character - Plant Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"I am strong, and you are in my woods!"'),
            'artist' => "Ba Vo",
            'extension' => 'TBF',
            'subtypes'  => [PLANT, DEITY],
            'effectDesc' => clienttranslate('#$<GIGANTIC>.#  {J} I gain 1 boost for each Expedition in {V}.'),
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 5,
            'costReserve' => 5,
            'changedStats' => ['forest', 'mountain', 'ocean'],
            'gigantic' => true,
            'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXForForest'])

        ];
    }
}
