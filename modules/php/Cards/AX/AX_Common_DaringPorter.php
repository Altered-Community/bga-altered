<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_DaringPorter extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_37_C',
            'asset'  => 'ALT_ALIZE_B_AX_37_C',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Daring Porter"),
            'typeline' => clienttranslate("Character - Adventurer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Someone has to shoulder the heavy burden of responsibility.'),
            'artist' => "Zero Wen",
            'extension' => 'TBF',
            'subtypes'  => [ADVENTURER],
            'effectDesc' => clienttranslate('{R} <EXHAUSTED_RESUPPLY>. (Put the top card of your deck in Reserve, then exhaust it {T}. Exhausted cards can\'t be played and have no Support abilities.)'),
            'forest' => 2,
            'mountain' => 3,
            'ocean' => 2,
            'costHand' => 3,
            'costReserve' => 3,
            'effectReserve' => FT::ACTION(RESUPPLY, ['exhausted' => true])
        ];
    }
}
