<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_FrozenDelivery extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_41_R1',
            'asset'  => 'ALT_ALIZE_B_AX_41_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Frozen Delivery"),
            'typeline' => clienttranslate("Spell - Conjuration"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('Precious supplies. If only the lid wasn\'t frozen shut...'),
            'artist' => "Romain Kurdi",
            'extension' => 'TBF',
            'subtypes'  => [CONJURATION],
            'effectDesc' => clienttranslate('#<EXHAUSTED_RESUPPLY>.# (Put the top card of your deck in Reserve, then exhaust it {T}. Exhausted cards can\'t be played and have no Support abilities.)'),
            'costHand' => 1,
            'costReserve' => 1,
            'effectPlayed' => FT::ACTION(RESUPPLY, ['exhausted' => true])
        ];
    }
}
