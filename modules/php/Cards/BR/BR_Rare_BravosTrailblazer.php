<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_BravosTrailblazer extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_35_R1',
            'asset'  => 'ALT_ALIZE_B_BR_35_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Bravos Trailblazer"),
            'typeline' => clienttranslate("Character - Adventurer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"It will be a collective effort; it must be a joint endeavor!"'),
            'artist' => "Zero Wen",
            'extension' => 'TBF',
            'subtypes'  => [ADVENTURER],
            'effectDesc' => clienttranslate('{J} I gain 1 boost #for each <FLEETING_CHAR> Character you control#.'),
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 2,
            'costHand' => 2,
            'costReserve' => 3,
            'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXFleetingChar']),
        ];
    }
}
