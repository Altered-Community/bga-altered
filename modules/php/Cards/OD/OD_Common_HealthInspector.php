<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_HealthInspector extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_55_C',
            'asset'  => 'ALT_BISE_B_OR_55_C',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Health Inspector"),
            'typeline' => clienttranslate("Character - Bureaucrat"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Using untested ingredients is a recipe for disaster.'),
            'artist' => "Justice Wong",
            'extension' => 'WFTM',
            'subtypes'  => [BUREAUCRAT],
            'effectDesc' => clienttranslate('Cards in your opponent\'s Reserve can\'t gain counters.'),
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 4,
            'costReserve' => 4,
            'blockOpponentReserveGain' => true,
        ];
    }
}
