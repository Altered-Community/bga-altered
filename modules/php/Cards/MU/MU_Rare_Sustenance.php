<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_Sustenance extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_61_R1',
            'asset'  => 'ALT_BISE_B_MU_61_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Sustenance"),
            'typeline' => clienttranslate("Spell - Conjuration"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('Anything goes when there are empty bellies to be filled.'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'WFTM',
            'subtypes'  => [CONJURATION],
            'effectDesc' => clienttranslate('<FLEETING>.  #Each player# draws a card.  Put the top card of #your# deck in #your# Mana zone (as an exhausted Mana Orb).'),
            'costHand' => 3,
            'costReserve' => 3,
            'changedStats' => ['costHand', 'costReserve'],
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::ACTION(DRAW, []),
                FT::ACTION(DRAW, ['players' => ME, 'location' => MANA, 'tapped' => true]),
            )
        ];
    }
}
