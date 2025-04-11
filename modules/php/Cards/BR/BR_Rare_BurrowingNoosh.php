<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_BurrowingNoosh extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_49_R2',
            'asset'  => 'ALT_BISE_B_MU_49_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Burrowing Noosh"),
            'typeline' => clienttranslate("Character - Plant Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('It takes years for roots to punch their way through the hardest stone, but for them it only takes a few hours.'),
            'artist' => "Ba Vo",
            'extension' => 'WFTM',
            'subtypes'  => [PLANT, ANIMAL],
            'effectDesc' => clienttranslate('#When an opponent draws one or more cards or <RESUPPLIES> — I gain 1 boost.#'),
            'forest' => 2,
            'mountain' => 0,
            'ocean' => 0,
            'costHand' => 1,
            'costReserve' => 1,
        ];
    }
}
