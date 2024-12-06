<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_BravosTrailblazer extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_35_C',
            'asset'  => 'ALT_ALIZE_B_BR_35_C',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Bravos Trailblazer"),
            'typeline' => clienttranslate("Character - Adventurer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"It will be a collective effort; it must be a joint endeavor!"'),
            'artist' => "Zero Wen",
            'extension' => 'TBF',
            'subtypes'  => [ADVENTURER],
            'effectDesc' => clienttranslate('{J} If you control a <FLEETING_CHAR> Character, I gain 1 boost.'),
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 2,
            'costHand' => 2,
            'costReserve' => 3,
            'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'hasControl::1::fleeting', 'effect' => FT::GAIN(ME, BOOST)])
        ];
    }
}
