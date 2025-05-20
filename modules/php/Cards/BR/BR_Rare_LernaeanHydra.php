<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_LernaeanHydra extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_59_R1',
            'asset'  => 'ALT_BISE_B_BR_59_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
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
            'costHand' => 5,
            'costReserve' => 5,
            'changedStats' => ['costHand', 'costReserve'],
            'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXMana'])
        ];
    }
}
