<?php

namespace ALT\Cards\AX;

class AX_Common_FrozenReprocessor extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_45_C',
            'asset'  => 'ALT_ALIZE_B_AX_45_C',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Frozen Reprocessor"),
            'typeline' => clienttranslate("Landmark_permanent - Construction"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Nothing is created, nothing is lost... even to the frost.'),
            'artist' => "Romain Kurdi",
            'extension' => 'TBF',
            'subtypes'  => [CONSTRUCTION, LANDMARK],
            'effectDesc' => clienttranslate('At Noon — <EXHAUSTED_RESUPPLY>. (Put the top card of your deck in Reserve, then exhaust it {T}. Exhausted cards can\'t be played and have no Support abilities.)  You may keep one more card in Reserve during Night if it\'s exhausted.'),
            'costHand' => 4,
            'costReserve' => 4,
        ];
    }
}
