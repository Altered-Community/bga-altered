<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Sustenance extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_61_C',
            'asset'  => 'ALT_BISE_B_MU_61_C',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Sustenance"),
            'typeline' => clienttranslate("Spell - Conjuration"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('Anything goes when there are empty bellies to be filled.'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'WFTM',
            'subtypes'  => [CONJURATION],
            'effectDesc' => clienttranslate('$<FLEETING>.  Draw a card.  Each player puts the top card of their deck in their Mana zone (as an exhausted Mana Orb).'),
            'costHand' => 2,
            'costReserve' => 2,
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::ACTION(DRAW, ['players' => ME]),
                FT::ACTION(DRAW, ['location' => MANA, 'tapped' => true]),
            )
        ];
    }
}
