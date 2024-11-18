<?php

namespace ALT\Cards\LY;

class LY_Common_SleightofHand extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_39_C',
            'asset'  => 'ALT_ALIZE_B_LY_39_C',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Sleight of Hand"),
            'typeline' => clienttranslate("Spell - Conjuration"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('"An old trick well done is far better than a new trick with no effect." - Houdini'),
            'artist' => "Edward Chee & Seok Yeong",
            'extension' => 'TBF',
            'subtypes'  => [CONJURATION],
            'effectDesc' => clienttranslate('<COOLDOWN>. (If I go to Reserve after my effect resolves, exhaust me {T}. Exhausted cards can\'t be played and have no Support abilities.)  Exchange target Character in your Reserve with a card from your Hand.'),
            'costHand' => 1,
            'costReserve' => 1,
        ];
    }
}
