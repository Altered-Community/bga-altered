<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_TechLabUnit extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_61_C',
            'asset'  => 'ALT_BISE_B_AX_61_C',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Tech Lab Unit"),
            'typeline' => clienttranslate("Landmark Permanent - Construction"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Two\'s company, three\'s a crowd.'),
            'artist' => "Justice Wong",
            'extension' => 'WFTM',
            'subtypes'  => [CONSTRUCTION, LANDMARK],
            'effectDesc' => clienttranslate('{J} $<RESUPPLY>.  Your Reserve limit is increased by one.'),
            'costHand' => 3,
            'costReserve' => 3,
            'effectPlayed' => FT::ACTION(RESUPPLY, []),
            'reserveSlots' => 1
        ];
    }
}
