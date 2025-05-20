<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_LernaeanHydra extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_59_C',
            'asset'  => 'ALT_BISE_B_BR_59_C',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Lernaean Hydra"),
            'typeline' => clienttranslate("Character - Dragon"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('If you want to butt heads, it\'ll probably win...'),
            'artist' => "Ed Chee, S.Yong & Stephen",
            'extension' => 'WFTM',
            'subtypes'  => [DRAGON],
            'effectDesc' => clienttranslate('{J} I gain 1 boost per Mana Orb in your Mana Zone.'),
            'forest' => 0,
            'mountain' => 0,
            'ocean' => 0,
            'costHand' => 6,
            'costReserve' => 6,
            'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXMana'])
        ];
    }
}
