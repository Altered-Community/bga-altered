<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_TheLittleMouse extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_53_C',
            'asset'  => 'ALT_BISE_B_MU_53_C',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("The Little Mouse"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('It fights tooth-for-tooth with the fairy.'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'WFTM',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('{H} <SABOTAGE>. If you discarded a card this way, its owner <EXHAUSTED_RESUPPLIES>. (They put the top card of their deck in Reserve, then they exhaust it {T}. Exhausted cards can\'t be played and have no Support abilities.)'),
            'forest' => 2,
            'mountain' => 3,
            'ocean' => 2,
            'costHand' => 3,
            'costReserve' => 2,
        ];
    }
}
